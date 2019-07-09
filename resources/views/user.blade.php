@extends('layouts.app')

@section('content')
<button type="button" class="btn btn-outline-success edit_user_info-btn" 
        data-name="{{Auth::user()->name}}" data-email="{{Auth::user()->email}}"
        data-id="{{Auth::user()->id}}" data-toggle="modal" data-target="#editInfo">Edit User Information
</button>
<button type="button" class="btn btn-outline-success edit_user_pass-btn" data-id="{{Auth::user()->id}}" data-toggle="modal" data-target="#editPass">Edit User Password
</button>
<label for="">Name:</label>
<input type="text" value="{{Auth::user()->name}}" readonly>
<label for="">Email:</label>
<input type="text" value="{{Auth::user()->email}}" readonly>

<!-- Modal Edit User Information -->
<div class="modal fade" id="editInfo" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Edit User Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="un" name="un"required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="em" name="em" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" id="edit_info">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit User Password -->
<div class="modal fade" id="editPass" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Edit User Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post">
                <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Current Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="cpw" name="cpw" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="pw" name="pw" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="cp" name="cp" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" id="edit_pass">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
