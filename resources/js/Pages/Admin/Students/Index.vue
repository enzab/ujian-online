<template>
    <Head>
        <title>Siswa &#8212; Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-5 col-12 mb-2">
                        <div class="row">
                            <div class="col-md-6 col-12 mb-2">
                                <Link href="/admin/students/create" type="button" class="btn btn-md btn-primary border-0 shadow w-100"><i class="fa fa-plus-circle"></i> Tambah</Link>
                            </div>
                            <div class="col-md-6 col-12 mb-2">
                                <Link class="btn btn-md btn-success border-0 shadow w-100 text-white"><i class="fa fa-file-excel"></i> Import</Link>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-12 mb-2">
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control border-0 shadow" placeholder="masukkan kata kunci dan enter...">
                                <span class="input-group-text border-0 shadow">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-centered table-nowrap mb-0 rounded">
                                <thead class="thead-dark">
                                    <tr class="border-0">
                                        <th class="border-0 rounded-start" style="width: 15px">No.</th>
                                        <th class="border-0" style="width: 5%">Nisn</th>
                                        <th class="border-0">Nama</th>
                                        <th class="border-0" style="width: 5%">Kelas</th>
                                        <th class="border-0" style="width: 5%">Jenis Kelamin</th>
                                        <th class="border-0" style="width: 20%">Password</th>
                                        <th class="border-0 rounded-end" style="width: 15px">Aksi</th>
                                    </tr>
                                </thead>
                                <div class="mt-2"></div>
                                <tbody>
                                    <tr v-for="(student, index) in students.data" :key="index">
                                        <td class="text-center">{{ ++index + (students.current_page - 1) * students.per_page }}</td>
                                        <td class="text-center">{{ student.nisn }}</td>
                                        <td class="text-center">{{ student.name }}</td>
                                        <td class="text-center">{{ student.classroom.title }}</td>
                                        <td class="text-center">{{ student.gender }}</td>
                                        <td class="text-center">{{ student.password }}</td>
                                        <td class="text-center">

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination :links="students.links" align="end"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    // import layout
    import LayoutAdmin from '../../../Layouts/Admin.vue';

    // import component pagination
    import Pagination from '../../../Components/Pagination.vue';

    // import Head and Link from Inertia
    import { Head, Link } from "@inertiajs/inertia-vue3";

    export default {
        // layout
        layout: LayoutAdmin,

        // register component
        components: {
            Head,
            Link,
            Pagination
        },

        // props
        props: {
            students: Object,
        }
    }
</script>