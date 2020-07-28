@extends('layouts.admin')
@section('styles')
@endsection
@section('content')
    <main id="main-container">
        <div class="content content-full pt-3 pb-3">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    All Membership
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3 mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx"href="{{url('admin/dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">AllMembership</li>
                    </ol>
                </nav>
            </div>
        </div>
 <div class="content">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Dynamic Table <small>Full</small></h3>
                        </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 80px;">ID</th>
                                        <th>Days</th>
                                        <th class="d-none d-sm-table-cell" style="width: 30%;">Products</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Price</th>
                                        <th style="width: 15%;">Paid/Not paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    	@foreach($packages as $packages)
                                        <td class="text-center font-size-sm">1</td>
                                        <td class="font-w600 font-size-sm">
                                           {{$packages->Days}}
                                        </td>
                                        <td class="d-none d-sm-table-cell font-size-sm">
                                            {{$packages->Products}}
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="badge badge-danger">{{$packages->Price}}</span>
                                        </td>
                                        <td>
                                            <em class="text-muted font-size-sm">10 days ago</em>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                  </main>
@endsection
