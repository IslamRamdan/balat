@extends('adminlte::page')

@section('title', 'تعديل العمل')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center bg-white p-3 rounded shadow-sm">
        <div>
            <h1 class="text-bold text-dark m-0" style="font-size: 1.6rem;">
                <i class="fas fa-briefcase text-primary ml-2"></i> تعديل العمل: <span
                    class="text-primary">{{ $blog->title }}</span>
            </h1>
            <p class="text-muted m-0 mt-1" style="font-size: 0.9rem;">تحديث بيانات المشروع الحالي في معرض الأعمال</p>
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
            <!-- تم الحفاظ على نفس الـ Action والمتغيرات للباك إند تماماً -->
            <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-outline card-primary shadow-sm border-0"
                    style="border-radius: 10px; overflow: hidden;">
                    <div class="card-body bg-light-soft p-4">
                        <div class="row">

                            {{-- العمود الأيمن: البيانات الأساسية --}}
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title" class="font-weight-bold text-dark mb-2">
                                        <i class="fas fa-heading ml-1 text-primary"></i> اسم العمل / المشروع
                                    </label>
                                    <input type="text" name="title" id="title"
                                        class="form-control form-control-lg border-custom custom-input"
                                        value="{{ $blog->title }}" placeholder="أدخل اسم العمل هنا..." required>
                                </div>
                            </div>

                            {{-- العمود الأيسر: إدارة ومعاينة الصورة --}}
                            <div class="col-md-4 border-right-custom">
                                <div class="form-group text-center">
                                    <label class="font-weight-bold d-block text-right mb-3">
                                        <i class="fas fa-image ml-1 text-primary"></i> صورة العمل الحالية
                                    </label>
                                    <div class="image-preview-wrapper mb-3 text-center d-flex align-items-center justify-content-center"
                                        style="height: 200px;">
                                        @if ($blog->image)
                                            <img id="image-preview" src="{{ asset('storage/' . $blog->image) }}"
                                                class="img-fluid rounded shadow-sm border"
                                                style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                        @else
                                            <div id="no-image-placeholder"
                                                class="bg-light d-flex flex-column align-items-center justify-content-center rounded border w-100 h-100">
                                                <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                                <span class="text-muted">لا توجد صورة حالياً</span>
                                            </div>
                                            <img id="image-preview" src="#" alt="معاينة الصورة"
                                                class="img-fluid rounded shadow-sm border"
                                                style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;">
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group mt-4">
                                    <label for="image" class="font-weight-bold text-dark mb-2">
                                        <i class="fas fa-upload ml-1 text-primary"></i> رفع صورة جديدة
                                    </label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image"
                                            accept="image/*">
                                        <label class="custom-file-label text-right" for="image">اختر ملف صورة...</label>
                                    </div>
                                    <small class="text-muted mt-2 d-block text-right">
                                        <i class="fas fa-info-circle ml-1"></i> يفضل استخدام صور عالية الجودة (JPG, PNG)
                                    </small>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer bg-white text-left py-3 px-4">
                        <button class="btn btn-success btn-lg px-5 shadow-sm rounded-pill font-weight-bold" type="submit"
                            style="font-size: 1rem;">
                            <i class="fas fa-save ml-1"></i> حفظ التحديثات
                        </button>
                    </div>
                </div>
            </form>
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

        /* تحسين الحقول Inputs */
        .custom-input {
            border-radius: 8px !important;
            border: 1px solid #dee2e6;
            transition: all 0.25s ease-in-out;
        }

        .custom-input:focus {
            border-color: #007bff !important;
            box-shadow: 0 0 8px rgba(0, 123, 255, .15) !important;
        }

        /* حاوية المعاينة للصورة */
        .image-preview-wrapper {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 8px;
            border: 1px dashed #ced4da;
        }

        /* تنسيق زر "تصفح" لرفع الملفات للـ RTL العربي */
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

        .form-control-lg {
            font-size: 1.05rem;
        }

        .bg-light-soft {
            background-color: #fcfcfd;
        }

        /* فاصل عمودي جهة اليسار لأن الاتجاه RTL */
        .border-right-custom {
            border-right: 1px solid #dee2e6;
        }

        @media (max-width: 767.98px) {
            .border-right-custom {
                border-right: none;
                border-top: 1px solid #dee2e6;
                margin-top: 2rem;
                padding-top: 2rem;
            }
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {

            // جافاسكريبت لمعاينة الصورة الجديدة فور اختيارها وتبديلها بالحالية
            $('#image').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        // إخفاء عنصر "لا توجد صورة" إن وجد، وإظهار عنصر الـ img
                        $('#no-image-placeholder').hide();
                        $('#image-preview').attr('src', event.target.result).show();

                        // تحديث نص الحقل لاسم الملف الجديد
                        $('.custom-file-label').text(file.name);
                    }
                    reader.readAsDataURL(file);
                }
            });

        });
    </script>
@stop
