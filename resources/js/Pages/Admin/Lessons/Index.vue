<template>
    <Head>
        <title>Mata Pelajaran</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3 col-12 mb-2">
                        <Link href="/admin/lessons/create" class="btn btn-md btn-primary border-0 shadow w-100">
                            <i class="fa fa-plus-circle"></i>
                            Tambah
                        </Link>
                    </div>
                    <div class="col-md-9 col-12 mb-2">
                        <form action="">
                            <div class="input-group">
                                <input type="text" name="" id="" placeholder="Masukkan kata kunci dan enter..." class="from-control border-0 shadow">
                                <span class="input-group-text border-0 shadow">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-1">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-centered table-nowrap mb-0 rounded">
                                <thead class="thead-dark">
                                    <tr class="border-0">
                                        <th class="border-0 rounded-start">No.</th>
                                        <th class="border-0">Nama Mata Pelajaran</th>
                                        <th class="border-0 rounded-end">Aksi</th>
                                    </tr>
                                </thead>
                                <div class="mt-2"></div>
                                <tbody>
                                    <tr v-for="(lesson, index) in lessons.data" :key="index">
                                        <td class="fw-bold text-center">{{ ++index + (lessons.current_page - 1) * lessons.per_page }}</td>
                                        <td>{{ lesson.title }}</td>
                                        <td class="text-center">
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination :links="lessons.links" align="end" />
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
            Pagination,
        },

        // props
        props: {
            lessons: Object,
        }
    }

</script>

<style>

</style>