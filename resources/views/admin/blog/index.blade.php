@extends('adminlte::page')

@section('title', 'عرض الاعمال')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-bold text-dark">عرض جميع الاعمال</h1>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle"></i> إضافة عمل جديد
        </a>
    </div>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="icon fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0"> {{-- إزالة الحواف الداخلية للجدول ليملأ الكارد --}}
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 50px" class="text-center">#</th>
                        <th style="width: 100px">الصورة</th>
                        <th>العنوان</th>
                        <th class="text-center" style="width: 150px">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr>
                            <td class="text-center align-middle font-weight-bold">{{ $loop->iteration }}</td>

                            <td class="align-middle">
                                @if ($blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}" class="rounded shadow-sm border"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary d-flex align-items-center justify-content-center rounded"
                                        style="width: 60px; height: 60px; font-size: 10px;">
                                        لا يوجد صورة
                                    </div>
                                @endif
                            </td>

                            <td class="align-middle text-bold text-primary">
                                {{ $blog->title }}
                            </td>

                            <td class="text-center align-middle">
                                <div class="btn-group">
                                    <a href="{{ route('admin.blog.edit', $blog->id) }}"
                                        class="btn btn-sm btn-outline-info mr-1" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد من حذف هذا العمل؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="حذف">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($blogs->isEmpty())
            <div class="card-footer text-center py-4">
                <p class="text-muted mb-0">لا توجد أعمال مضافة حتى الآن.</p>
            </div>
        @endif
    </div>

@stop

@section('css')
    <style>
        .table td,
        .table th {
            vertical-align: middle;
        }

        .btn-group form {
            display: inline-block;
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
@stop
