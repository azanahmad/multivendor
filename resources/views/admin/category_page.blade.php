@extends('../layouts.layout')
@section('title')
    Category
@endsection
@section('body')
    <main id="main-container">
        <div class="bg-body-light">
            <div class="content content-full pt-2 pb-2">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill h4 my-2">
                        Categories
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="{{url('admin/dashboard')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">Categories</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @if(session()->has('message'))

            <div>
                <p class="alert alert-info">{{session('message')}}</p>
            </div>
        @endif
        <div class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="block" style="height: 28rem;">

                        <div class="block-content block-content-narrow">
                            <form class="form-horizontal" action="{{url('admin/save_category')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <label for="material-error">Category</label>
                                            <input class="form-control" type="text" id="cat" name="cat_name"
                                                   placeholder="Enter Category Title here" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <button class="btn btn-sm btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block" style="min-height: 28rem;">

                        <div class="block-content block-content-narrow">
                            <form class="form-horizontal push-10-t" action="{{url('admin/save_sub_category')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <label for="material-select">Select Category</label>
                                            <select class="form-control" id="material-select" name="category_id"
                                                    size="1">
                                                @foreach($categories as $categorie)
                                                    <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group sub_cat_start d-flex">
                                    <div class="col-sm-12">
                                        <div class="form-material">
                                            <label for="material-error">Sub Category</label>
                                            <input class="form-control" type="text" id="sub_cat" name="sub_name"
                                                   placeholder="Enter Sub Category Title here" required>
                                        </div>
                                    </div>

                                </div>

                                <div style="display: none;">
                                    <div class="form-group append_sub_category">
                                        <div class="col-sm-12">
                                            <div class="form-material">
                                                <input class="form-control" type="text" name="sub_title[]"
                                                       placeholder="Enter Sub Category Title here">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <button class="btn btn-sm btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block">
                <div class="block-content">
                    <table class="js-table-sections table table-hover table-borderless  table-vcenter">
                        <thead>
                        <tr>
                            <th style="width: 30px;"></th>
                            <th>Title</th>
                            <th style="width: 15%;"></th>
                            <th class="text-center" style="width: 15%;"></th>
                        </tr>
                        </thead>
                        @foreach($categories as $category)
                            <tbody class="toggle">
                            <tr>

                                <td class="text-center">
                                    <i class="fa fa-angle-right"></i>
                                </td>
                                <td class="font-w600">  <img class="img-avatar img-avatar48" src="{{asset('icons/'.$category->icon)}}" alt=""> {{$category->name}}</td>
                                <td>
                                    <span class="label label-primary"></span>
                                </td>
                                <td class="hidden-xs btn-group">

                                    <button class="btn btn-sm btn-warning" type="button" data-toggle="modal"
                                            data-target="#modal-category_{{$category->id}}" title="Edit Category"><i
                                            class="fa fa-edit"></i></button>
                                    <a href="{{url('admin/category/delete/'.$category->id)}}"
                                       class="btn btn-sm btn-danger" type="button" data-toggle="tooltip" title=""
                                       data-original-title="Delete Category"><i class="fa fa-times"></i></a>
                                </td>

                            </tr>
                            <div class="modal fade" id="modal-category_{{$category->id}}" tabindex="-1" role="dialog"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-popin">
                                    <div class="modal-content">
                                        <div class="block block-themed block-transparent remove-margin-b">
                                            <div class="block-header bg-primary-dark">
                                                <h3 class="block-title">Update {{$category->name}}</h3>
                                                <div class="block-options">
                                                    <button type="button" class="btn-block-option">
                                                        <i class="fa fa-fw fa-times"  data-dismiss="modal" aria-label="Close"></i>
                                                    </button>
                                                </div>

                                            </div>
                                            <div class="block-content">
                                                <form class="form-horizontal push-10-t"
                                                      action="{{url('admin/category/update')}}"
                                                      method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" value="{{$category->id}}" name="category_id">
                                                    <div class="form-group">
                                                        <label for="">Title</label>
                                                        <input type="text" class="form-control" name="name"
                                                               value="{{$category->name}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Icon</label>
                                                        <input type="file" class="form-control" name="icon">
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <button class="btn btn-sm btn-success " type="submit">Update
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </tbody>

                            <tbody class="show_tbody">
                            @foreach($category->subcategory as $subcategory)
                                <tr>

                                    <td class="text-center text-success">
                                    </td>
                                    @if(isset($category->subcategory))

                                        <td class="font-w600 text-success">{{$subcategory->Subcategory_name}}</td>

                                    @else
                                        <td class="font-w600 text-success">No subcategory added</td>
                                    @endif
                                    <td>
                                        <small></small>
                                    </td>
                                    <td class="hidden-xs btn-group ">
                                        <button class="btn btn-sm btn-warning" type="button" data-toggle="modal"
                                                data-target="#sub_{{$subcategory->id}}" title="Edit SubCategory"><i
                                                class="fa fa-edit"></i></button>

                                        @if(isset($category->subcategory))
                                            <a href="{{url('admin/subcategory/delete/'.$subcategory->id)}}"
                                               class="btn btn-sm btn-danger" data-toggle="tooltip" title=""
                                               data-original-title="Delete SubCategory"><i class="fa fa-times"></i></a>
                                        @else
                                            <button>N</button>
                                        @endif
                                        <div class="modal fade" id="sub_{{$subcategory->id}}" tabindex="-1" role="dialog"
                                             aria-hidden="true">

                                            <div class="modal-dialog modal-dialog-popin">
                                                <div class="modal-content">
                                                    <div class="block block-themed block-transparent remove-margin-b">
                                                        <div class="block-header bg-primary-dark">
                                                            <h3 class="block-title">Update Subcatagory {{$subcategory->Subcategory_name}}</h3>
                                                            <div class="block-options">
                                                                <button type="button" class="btn-block-option">
                                                                    <i class="fa fa-fw fa-times"  data-dismiss="modal" aria-label="Close"></i>
                                                                </button>
                                                            </div>

                                                        </div>
                                                        <div class="block-content">
                                                            <form class="form-horizontal push-10-t"
                                                                  action="{{url('admin/subcategory/update')}}"
                                                                  method="post">
                                                                @csrf
                                                                @if(isset($category->subcategory))

                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="subcategory_name"
                                                                               value="{{$subcategory->Subcategory_name}}">

                                                                    </div>
                                                                    <input type="hidden" value="{{$subcategory->Categorie_id}}" name="category_id">
                                                                    <input type="hidden" value="{{$subcategory->id}}" name="subcategory_id">
                                                                @else
                                                                    <input type="text" class="form-control" name="subcategory_name"
                                                                           value="No subcategory">
                                                                @endif
                                                                <div class="form-group text-right">
                                                                    <button class="btn btn-sm btn-success " type="submit">
                                                                        Update
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){

            $('.show_tbody').hide();
            $(function () {
                $('.toggle').on('click', function () {
                    $(this).next('.show_tbody').toggle();
                });
            });
        });
    </script>

@endsection
