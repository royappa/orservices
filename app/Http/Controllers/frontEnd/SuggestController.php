<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Map;
use App\Model\Organization;
use App\Model\Suggest;
use App\Model\Email;
use App\Model\Layout;
use App\Model\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use SendGrid;
use SendGrid\Mail\Mail;

class SuggestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $layout = Layout::find(1);
        $map = Map::find(1);
        $organizations = Organization::orderBy('organization_name')->pluck('organization_name', "organization_recordid");

        return view('frontEnd.suggest.create', compact('map', 'organizations', 'layout'));
    }

    public function add_new_suggestion(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'suggest_organization' => 'required',
            'name' => 'required',
            'email' => 'required',
        ]);
        try {
            $layout = Layout::find(1);

            $site_name = '';
            if ($layout) {
                $site_name = $layout->site_name;
            }
            $suggest = new Suggest;

            $new_recordid = Suggest::max('suggest_recordid') + 1;
            $suggest->suggest_recordid = $new_recordid;
            $suggest->suggest_organization = $request->suggest_organization;
            $organization_info = Organization::where('organization_recordid', '=', $request->suggest_organization)->first();
            $suggest->suggest_content = $request->suggest_content;
            $suggest->suggest_username = $request->name;
            $suggest->suggest_user_email = $request->email;

            $suggest->suggest_user_phone = $request->phone;

            $from = env('MAIL_FROM_ADDRESS');
            $name = env('MAIL_FROM_NAME');
            // $from_phone = env('MAIL_FROM_PHONE');

            $email = new Mail();
            $email->setFrom($from, $name);
            $subject = 'A Suggested Change was Submitted at ' . $site_name;
            $email->setSubject($subject);

            $body = $request->suggest_content;

            $message = '<html><body>';
            $message .= '<h1 style="color:#424242;">Thanks for your suggestion!</h1>';
            $message .= '<p style="color:#424242;font-size:18px;">The following change was suggested at  ' . $site_name . ' website.</p>';
            $message .= '<p style="color:#424242;font-size:12px;">ID: ' . $new_recordid . '</p>';
            $message .= '<p style="color:#424242;font-size:12px;">Timestamp: ' . Carbon::now() . '</p>';
            $message .= '<p style="color:#424242;font-size:12px;">Organization: ' . $organization_info->organization_name . '</p>';
            $message .= '<p style="color:#424242;font-size:12px;">Body: ' . $body . '</p>';
            $message .= '<p style="color:#424242;font-size:12px;">From: ' . $request->name . '</p>';
            $message .= '<p style="color:#424242;font-size:12px;">Email: ' . $request->email . '</p>';
            $message .= '<p style="color:#424242;font-size:12px;">Phone: ' . $request->phone . '</p>';
            // $message .= '<p style="color:#424242;font-size:12px;">Phone: '. $from_phone .'</p>';
            $message .= '</body></html>';

            $email->addContent("text/html", $message);
            $sendgrid = new SendGrid(getenv('SENDGRID_API_KEY'));

            $error = '';

            $username = '';
            $contact_email_list = Email::select('email_info')->pluck('email_info')->toArray();

            foreach ($contact_email_list as $key => $contact_email) {
                $email->addTo($contact_email, $username);
            }
            $response = $sendgrid->send($email);
            if ($response->statusCode() == 401) {
                $error = json_decode($response->body());
            }
            $suggest->save();
            Session::flash('message', 'Your suggestion has been received.');
            Session::flash('status', 'success');
            return redirect('suggest/create');
        } catch (\Throwable $th) {

            Session::flash('message', $th->getMessage());
            Session::flash('status', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function create_user()
    {
        $map = Map::find(1);
        $organizations = Organization::orderBy('organization_name')->pluck('organization_name', "organization_recordid");
        $roles = Role::where('name', 'Organization Admin')->pluck('name', 'id');

        return view('frontEnd.suggest.create_user', compact('map', 'organizations', 'roles'));
    }
    public function store_user(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);
        try {
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = $request->role;
            $user->created_by = Auth::id();
            $user->save();
            // $EmailTemplate = EmailTemplate::whereId(1)->where('status', 1)->first();

            // if ($EmailTemplate) {
            //     $from = env('MAIL_FROM_ADDRESS');
            //     $name = env('MAIL_FROM_NAME');
            //     $email = new Mail();
            //     $email->setFrom($from, $name);
            //     // $subject = 'A Suggested Change was Submitted at ' . $site_name;
            //     $subject = $EmailTemplate->subject;

            //     $email->setSubject($subject);

            //     // $body = $request->message;
            //     $data = array(
            //         '{first_name}' => $request->get('first_name') . ' ' . $request->get('last_name'),
            //         '{password}' => $request->get('password'),
            //     );
            //     $body = $EmailTemplate->body;

            //     foreach ($data as $key => $value) {
            //         //replace the email template body string to user detail
            //         $body = str_replace($key, $value, $body);
            //     }

            //     $message = '<html><body>';
            //     $message .= $body;
            //     $message .= '</body></html>';

            //     $email->addContent("text/html", $message);
            //     $sendgrid = new SendGrid(getenv('SENDGRID_API_KEY'));

            //     $error = '';

            //     $username = '';
            //     // $contact_email_list = Email::select('email_info')->pluck('email_info')->toArray();

            //     // foreach ($contact_email_list as $key => $contact_email) {
            //     $email->addTo($request->email, $username);
            //     // }
            //     $response = $sendgrid->send($email);
            //     if ($response->statusCode() == 401) {
            //         $error = json_decode($response->body());
            //     }
            // }
            // $ActivationEmail = EmailTemplate::whereId(2)->where('status', 1)->first();
            // if ($ActivationEmail && $request->role) {
            //     $from = env('MAIL_FROM_ADDRESS');
            //     $name = env('MAIL_FROM_NAME');
            //     $email = new Mail();
            //     $email->setFrom($from, $name);
            //     // $subject = 'A Suggested Change was Submitted at ' . $site_name;
            //     $subject = $ActivationEmail->subject;

            //     $email->setSubject($subject);

            //     // $body = $request->message;
            //     $data = array(
            //         '{first_name}' => $request->get('first_name') . ' ' . $request->get('last_name'),
            //         '{password}' => $request->get('password'),
            //     );
            //     $body = $ActivationEmail->body;

            //     foreach ($data as $key => $value) {
            //         //replace the email template body string to user detail
            //         $body = str_replace($key, $value, $body);
            //     }

            //     $message = '<html><body>';
            //     $message .= $body;
            //     $message .= '</body></html>';

            //     $email->addContent("text/html", $message);
            //     $sendgrid = new SendGrid(getenv('SENDGRID_API_KEY'));

            //     $error = '';

            //     $username = '';
            //     // $contact_email_list = Email::select('email_info')->pluck('email_info')->toArray();

            //     // foreach ($contact_email_list as $key => $contact_email) {
            //     $email->addTo($request->email, $username);
            //     // }
            //     $response = $sendgrid->send($email);
            //     if ($response->statusCode() == 401) {
            //         $error = json_decode($response->body());
            //     }
            // }
            Session::flash('message', 'Success! User is created successfully.');
            Session::flash('status', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('message', $th->getMessage());
            Session::flash('status', 'error');
            return redirect()->back()->withInput();
        }
    }
}
