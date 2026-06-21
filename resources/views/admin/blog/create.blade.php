@extends('adminlte::page')

@section('title', 'إضافة عمل جديد')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center bg-white p-3 rounded shadow-sm">
        <div>
            <h1 class="text-bold text-dark m-0" style="font-size: 1.6rem;">
                <i class="fas fa-briefcase text-primary ml-2"></i> إضافة عمل جديد
            </h1>
            <p class="text-muted m-0 mt-1" style="font-size: 0.9rem;">قم بإضافة مشروع جديد إلى معرض أعمالنا</p>
        </div>
        <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary btn-sm px-3 rounded-pill">
            <i class="fas fa-arrow-right ml-1"></i> العودة للأعمال
        </a>
    </div>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert"
            style="border-right: 4px solid #28a745 !important;">
            <i class="icon fas fa-check-circle ml-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-outline card-primary shadow-sm border-0" style="border-radius: 10px; overflow: hidden;">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title text-bold text-muted mb-0 float-none" style="font-size: 1rem;">
                        <i class="fas fa-edit ml-1"></i> أدخل تفاصيل العمل أدناه
                    </h3>
                </div>

                <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body bg-light-soft p-4">
                        <div class="row">

                            {{-- اسم العمل / المشروع --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title" class="font-weight-bold text-dark mb-2">
                                        <i class="fas fa-heading ml-1 text-primary"></i> اسم العمل / المشروع
                                    </label>
                                    <input type="text" name="title" id="title"
                                        class="form-control form-control-lg border-custom custom-input"
                                        placeholder="اكتب اسماً مميزاً للمشروع..." required>
                                </div>
                            </div>

                            {{-- رفع صورة العمل --}}
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="image" class="font-weight-bold text-dark mb-2">
                                        <i class="fas fa-image ml-1 text-primary"></i> الصورة الرئيسية للعمل
                                    </label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image"
                                            required accept="image/*">
                                        <label class="custom-file-label text-right" for="image">اختر صورة
                                            للمشروع...</label>
                                    </div>
                                    <small class="text-muted mt-2 d-block">
                                        <i class="fas fa-info-circle ml-1"></i> يفضل استخدام أبعاد متناسقة للمشروع (مثل
                                        1200x630)
                                    </small>
                                </div>
                            </div>

                            {{-- حاوية عرض الصورة --}}
                            <div class="col-md-6 mt-2 d-flex align-items-center justify-content-center">
                                <div id="image-preview-container" class="image-preview-container text-center rounded border"
                                    style="width: 100%; max-width: 300px; height: 200px; display: none;">
                                    <img id="image-preview" src="#" alt="معاينة الصورة"
                                        style="max-width: 100%; max-height: 100%; border-radius: 8px;" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white text-left py-3 px-4">
                        <button class="btn btn-primary btn-lg px-5 shadow-sm rounded-pill font-weight-bold" type="submit"
                            style="font-size: 1rem;">
                            <i class="fas fa-save ml-1"></i> حفظ وإضافة العمل
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">
    <style>
        /* خط علوي ناعم للكارت */
        .card-outline.card-primary {
            border-top: 4px solid #007bff !important;
        }

        /* تعديل حواف وحجم حقل النص */
        .custom-input {
            border-radius: 8px !important;
            border: 1px solid #dee2e6;
            transition: all 0.25s ease-in-out;
        }

        .custom-input:focus {
            border-color: #007bff !important;
            box-shadow: 0 0 8px rgba(0, 123, 255, .15) !important;
        }

        /* تنسيق زر "تصفح" لرفع الملفات في الـ RTL العربي */
        .custom-file-label::after {
            content: "تصفح" !important;
            left: 0 !important;
            right: auto !important;
            border-left: none !important;
            border-right: 1px solid #ced4da !important;
            border-radius: 8px 0 0 8px !important;
            padding: 0.375rem 1rem;
        }

        .custom-file-label {
            border-radius: 8px !important;
            padding: 0.375rem 1rem;
        }

        .note-editor {
            border: none !important;
        }

        .form-control-lg {
            font-size: 1.05rem;
        }

        .bg-light-soft {
            background-color: #fcfcfd;
        }

        /* تنسيق حاوية عرض الصورة */
        .image-preview-container {
            border: 2px dashed #ced4da;
            padding: 10px;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // الاستماع لتغيير قيمة حقل الإدخال
            $('#image').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        // تعيين مصدر الصورة في حاوية العرض
                        $('#image-preview').attr('src', event.target.result);
                        // إظهار حاوية العرض
                        $('#image-preview-container').show();
                        // تحديث نص الحقل باسم الملف
                        $('.custom-file-label').text(file.name);
                    }
                    reader.readAsDataURL(file);
                } else {
                    // إخفاء حاوية العرض إذا لم يتم اختيار ملف
                    $('#image-preview-container').hide();
                    // إعادة تعيين نص الحقل
                    $('.custom-file-label').text('اختر صورة للمشروع...');
                }
            });
        });
    </script>
@stop
