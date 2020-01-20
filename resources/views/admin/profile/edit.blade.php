@extends('admin.layouts.app')

@section('content')

   <div class="container">
       <div class="container">
           <form action="{{ route('admin.profile.update',['admin'=>$user]) }}" method="post" enctype="multipart/form-data">
               @csrf
           <h1>Edit Profile</h1>
           <hr>
           <div class="row">
               <!-- left column -->
               <div class="col-md-3">
                   <div class="text-center">
                       <div>
                           <input type="file" name="image" class="dropify"  data-default-file="{{ asset($user->image) }}">
                       </div>
                   </div>
               </div>
               <!-- edit form column -->
               <div class="col-md-9 personal-info">
                   <h3>Personal info</h3>

                       <div class="form-group">
                           <label for="name" class="col-lg-3 control-label">First name:</label>
                           <div class="col-lg-8">
                               <input id="name" name="name" class="form-control @error('name') is-invalid @enderror " type="text" value="{{ $user->name }}">
                           </div>

                       </div>
                       <div class="form-group">
                           <label class="col-lg-3 control-label" for="email">Email:</label>
                           <div class="col-lg-8">
                               <input name="email" id="email" class="form-control @error('email') is-invalid @enderror" type="text" value="{{ $user->email }}">
                           </div>
                       </div>
                       <div class="form-group">
                           <label for="password" class="col-md-3 control-label">Old password:</label>
                           <div class="col-md-8">
                               <input id="password"  name="old_password" class="form-control  @error('old_password') is-invalid @enderror" type="password" value="">
                           </div>
                       </div>
                       <div class="form-group">
                           <label for="password" class="col-md-3 control-label">New password:</label>
                           <div  class="col-md-8">
                               <input name="password" id="password" class="form-control" type="password" value="">
                           </div>
                       </div>
                       <div class="form-group">
                           <label for="password_confirmation" class="col-md-3 control-label">Confirm password:</label>
                           <div  class="col-md-8">
                               <input name="password_confirmation" id="password_confirmation" class="form-control" type="password" value="">
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="col-md-3 control-label"></label>
                           <div class="col-md-8">
                               <input type="submit" class="btn btn-primary" value="Save Changes">
                               <span></span>
                               <input type="reset" class="btn btn-default" value="Cancel">
                           </div>
                       </div>
               </div>
           </div>
           </form>
       </div>
       <hr>
   </div>

@endsection
