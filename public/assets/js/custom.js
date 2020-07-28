$(document).ready(function(){

    //tags_input
    $(function () {
        $('.tags').tagsInput({
            height: '36px',
            width: '300px',
            defaultText: 'Add tag',
            removeWithBackspace: true,
            delimiter: [','],
            onChange: function () {
                var price = $('input[type="text"][name="price"]').val();
                var sku = $('input[type="text"][name="sku"]').val();
                var quantity = $('input[type="number"][name="quantity"]').val();
                var barcode = $('input[type="text"][name="barcode"]').val();
                var option1 = $('input[type="text"][name="option1_value"]').val();
                var option2 = $('input[type="text"][name="option2_value"]').val();
                var option3 = $('input[type="text"][name="option3_value"]').val();
                var substr1 = option1.split(',');
                var substr2 = option2.split(',');
                var substr3 = option3.split(',');
                $('.variants_table').show();
                $("tbody").empty();
                var title = '';
                jQuery.each(substr1, function (index1, item1) {
                    title = item1;
                    jQuery.each(substr2, function (index2, item2) {
                        if (item2 !== '') {
                            title = item1 + '/' + item2;
                        }
                        jQuery.each(substr3, function (index3, item3) {

                            if (item3 !== '') {
                                title = item1 + '/' + item2 + '/' + item3;
                            }

                            $('tbody').append('   <tr>\n' +
                                '                                                    <td class="variant_title">' + title + '<input type="hidden" name="variant_title[]" value="' + title + '"></td>\n' +
                                '                                                    <td><input type="text" class="form-control" name="variant_price[]" placeholder="$0.00" value="' + price + '">\n' +
                                '                                                    </td>\n' +
                                '                                                    <td><input type="text" class="form-control" name="variant_quantity[]" value="' + quantity + '" placeholder="0"></td>\n' +
                                '                                                    <td><input type="text" class="form-control" name="variant_sku[]" value="' + sku + '"></td>\n' +
                                '                                                    <td><input type="text" class="form-control" name="variant_barcode[]"  value="' + barcode + '"  placeholder=""></td>\n' +
                                '                                                </tr>');
                        });
                    });
                });
            },
        });

    });

    $(function () {
        $('#shipping').on('change', function () {
            $('#content').slideToggle(this.checked);
        });
    });
    $('#content').hide();
    $('#content1').hide();
    $(function () {
        $('#varients').on('change', function () {
            $('#content1').slideToggle(this.checked);
        });
    });
    $('#option2').hide();
    $('#option3').hide();
    $(function () {
        $('#button').on('click', function () {
            $('#option2').show();
        });
    });
    $(function () {
        $('#button1').on('click', function () {
            $('#option3').show();
        });

    });
    //images
    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function(e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove\">Remove</span>" +
                        "</span>").insertAfter("#img_preview");
                    $(".remove").click(function(){
                        $(this).parent(".pip").remove();
                    });

                    // Old code here
                    /*$("<img></img>", {
                      class: "imageThumb",
                      src: e.target.result,
                      title: file.name + " | Click to remove"
                    }).insertAfter("#files").click(function(){$(this).remove();});*/

                });
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API")
    }
    //product_form
    $('product-form').submit(function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var myForm = document.getElementById('product-form');
        var formData = new FormData(myForm);
        $.ajax({
            url: 'post_product',
            method: 'post',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                if (result.success == 0) {
                    if (result.validation == 0) {
                        if (result.message.title) {
                            $('.title_error').html(result.message.title[0]);
                        } else {
                            $('.name_error').html('');
                        }
                        if (result.message.descrip) {
                            $('.descrip_error').html(result.message.descrip[0]);
                        }
                        if (result.message.price) {
                            $('.price_error').html(result.message.price[0]);
                        }
                        if (result.message.compare_price) {
                            $('.campare_price_error').html(result.message.compare_price[0]);
                        }
                        if (result.message.files) {
                            $('.image_error').html(result.message.files[0]);
                        }
                        if (result.message.sku) {
                            $('.sku_error').html(result.message.sku[0]);
                        }
                        if (result.message.barcode) {
                            $('.barcode_error').html(result.message.barcode[0]);
                        }
                        if (result.message.quantity) {
                            $('.quantity_error').html(result.message.quantity[0]);
                        }
                    }
                }
                else {
                    bootbox.alert({
                        title: "Message",
                        message: result.message,
                        callback: function () {
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }
                    });
                }
            }});
    });


});

//dropzone
// <script type="text/javascript">
// Dropzone.options.dropzone = {
//     maxFiles: 1,
//     paramName: 'file',
//     addRemoveLinks: true,
//     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//     accept: function(file, done) {
//         console.log("uploaded");
//         done();
//     },
//     init: function() {
//         this.on("maxfilesexceeded", function(file){
//             alert("No more files please!");
//             this.removeFile(file);
//         });
// // this.on("addedfile", function(file) {
// //    myDropzone.options.removefile.call(myDropzone, mockFile);
// //    //  I want to delete an existing element
// //  });
//     }
// };
//jquery
//         $('tags').on('change',function(){
//             value =$(this).val();
//             var form = $('#tags').serialize();
//             var url = "{{url('varients')}}";
//
//             console.log(form);
//             $.ajax({url: url,data:form, success: function(result){
//                     console.log(result.value);
//                     x= $(".variants_table").html();
//                     $('#content1').after(x);
//                     split= result.value.split(',');
//                     console.log(split);
//                     $('#text').text(split);
//
//
//                 }});
//             $.each(names,function(index,names) {
//                 var x = $('.variants_table').html();
//                 $('#content1').after(x);
//                 $('#text').val(value);
//             });
//         });
//
//         $(".btn-success").click(function(){
//             var lsthmtl = $(".clone").html();
//             $(".increment").after(lsthmtl);
//         });
//         $('.hide').hide();
//         $("body").on("click",".btn-danger",function(){
//             $(this).parents(".control-group").remove();
//         });
//dropzone html
// <div action="\"
// class="dropzone"
// id="dropzone"></div>
//     <div action="/" id="dropzone" class="dropzone">
//     <div class="dz-message">
//     Click here to upload photos
// </div>
// <div class="fallback">
//     <input style="display: none" accept="image/*"  type="file"  name="images[]" class="push-30-t dz-hidden-input push-30 images-upload" multiple>
// </div>
// </div>
//
// <div class="dropzone">
//     <div class="input-group hdtuto control-group lst increment" >
//     <label class="btn btn-link">Choose images
// <input type="file" name="filenames[]" id="thumbnail" class="myfrm form-control"  style="color: transparent; width:90px;display: none" >
//     </label>
//     <div class="input-group-btn" style="margin-left: 420px">
//     <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
// </div>
// </div>
// <img src="" id="imgthumbnail" class="img-circle" width="150" />
//     <div class="clone hide">
//     <div class="hdtuto control-group lst input-group" style="margin-top:10px">
//     <label class="btn btn-link">Choose images
// <input type="file" name="filenames[]" id="thumbnail" class="myfrm form-control"  style="color: transparent; width:90px;display: none" >
//     </label>
//     <div class="input-group-btn"   style="margin-left: 420px">
//     <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
// </div>
// </div>
// </div>
// </div>
//ajx edit
// {{--$.ajax({url:"{{url('admin/edit_rate')}}",--}}
//     {{--    data: {--}}
//         {{--        'id': $("#shipping_id").val(),--}}
//         {{--    },--}}
//     {{--    type: 'get',--}}
//     {{--    success:function(result){--}}
//         {{--    $(result).append('.show_tbody');--}}
//         {{--        $(this).next('.show_tbody').toggle();--}}
//         {{--    }});--}}
