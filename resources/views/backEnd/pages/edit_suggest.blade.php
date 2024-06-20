@extends('backLayout.app')
	@section('title')
	Edit Suggest
	@stop

	@section('content')

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Edit Suggest</h2>
					{{-- <ul class="nav navbar-right panel_toolbox">
						<li>
							<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
						<li>
							<a class="close-link"><i class="fa fa-close"></i></a>
						</li>
					</ul> --}}
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					{!! Form::model($layout, [
					'url' => ['suggest_edit', 1],
					'class' => 'form-horizontal',
					'method' => 'put',
					'enctype'=> 'multipart/form-data'
					]) !!}
                        <div class="form-group {{ $errors->has('suggest_title') ? 'has-error' : ''}}">
							{!! Form::label('suggest_title', 'Title ', ['class' => 'col-sm-3 control-label']) !!}
							<div class="col-sm-6">
							{!! Form::text('suggest_title', null, ['class' => 'form-control']) !!}
							{!! $errors->first('suggest_title', '<p class="help-block">:message</p>') !!}
							</div>
                        </div>
						<div class="form-group {{ $errors->has('suggest_organization_description') ? 'has-error' : ''}}">
							{!! Form::label('suggest_organization_description', 'The words under Organization subheading', ['class' => 'col-sm-3 control-label']) !!}
							<div class="col-sm-6">
							{!! Form::text('suggest_organization_description', null, ['class' => 'form-control']) !!}
							{!! $errors->first('suggest_organization_description', '<p class="help-block">:message</p>') !!}
							</div>
						</div>
                        <div class="form-group {{ $errors->has('suggest_suggestion_description') ? 'has-error' : ''}}">
							{!! Form::label('suggest_suggestion_description', 'The words under Suggestion subheading', ['class' => 'col-sm-3 control-label']) !!}
							<div class="col-sm-6">
							{!! Form::text('suggest_suggestion_description', null, ['class' => 'form-control']) !!}
							{!! $errors->first('suggest_suggestion_description', '<p class="help-block">:message</p>') !!}
							</div>
						</div>
						{{-- 
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Banner Text1
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input id="occupation" type="text" name="banner_text1" class="optional form-control col-md-7 col-xs-12" value="{{$layout->banner_text1}}">
                            </div>
                          </div>
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Banner Text2
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input id="occupation" type="text" name="banner_text2" class="optional form-control col-md-7 col-xs-12" value="{{$layout->banner_text2}}">
                            </div>
                          </div>
                        --}}
					
						<div class="form-group m-form__group row">
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-6">
									{!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
									{!! Form::close() !!}
								</div>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

	@endsection
	@section('scripts')
	<script>
		$(document).ready(function() {
			$('#summernote').summernote({
				height: 300
			});
			$('#summernote1').summernote({
				height: 100
			});
			$('#summernote2').summernote({
				height: 100
			});
			$('#summernote3').summernote({
				height: 100
			});
		});
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#home_bk_img')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
	</script>
	@endsection
