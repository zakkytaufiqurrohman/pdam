@extends('layouts.admin.app')

@section('body')

<div class="content-wrapper">
        <section class="content">
          <div class="callout callout-info">
            <h4>welcome</h4>
          <p>selamat datang {{auth::user()->name}}</p>
          </div>
        </section>
        <!-- /.content -->
      </div>
@endsection
