@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12" style="margin:auto; float:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Manage Photos</h3>
            </div>
            <div class="panel-body">
                @if(Session::has('warning'))
                <div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">&times;</button>{{ Session::get('warning') }}</div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <button data-dismiss="alert" class="close" type="button">&times;</button>
                    <h4>Warning!</h4>
                    {{ implode('', $errors->all(':message</br>')) }}
                </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <button id="image-gallery-button" type="button" class="btn btn-primary btn-lg pull-right"  data-toggle="modal" data-target="#myModal">
                            <i class="glyphicon glyphicon-picture"></i>
                            Upload Computation
                        </button>
                        <a id="image-gallery-button" class="btn btn-danger btn-lg pull-left" href="{{ URL::to('admin/properties') }}">
                            <i class="glyphicon glyphicon-home"></i>
                            Back To Properties
                        </a>
                        <br>
                    </div>
                    <div class="clearfix" style="margin-bottom:15px;"></div>
                    <div class="col-lg-2 col-md-4 col-xs-6 thumb">
                        <div align="center"><img src="{{ Property::get_computation($property_id,array(600,600)) }}"/></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Upload Photo</h4>
            </div>
            <div class="modal-body" style="padding-bottom:0px;">
                <form enctype="multipart/form-data" method="POST">
                    <span class="btn btn-default btn-file" style="width:86%;">
                        Browse <input type="file" name="photo" accept="image/*">
                    </span>
                    <input type="submit" class="btn btn-primary" value="Upload" name="submit"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
@stop