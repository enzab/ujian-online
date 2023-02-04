<template>
    <Head>
        <title>Tambah Siswa - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link class="btn btn-md btn-primary border-0 shadow mb-3" type="button" href="/admin/students"><i class="fa fa-long-arrow-alt-left me-2"></i>Kembali</Link>
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5><i class="fa fa-user"></i>Tambah Siswa</h5>
                        <hr>
                        <form @submit.prevent="submit" action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="">Nisn</label>
                                        <input type="text" class="form-control" placeholder="Masukkan Nisn Siswa" v-model="form.nisn">
                                        <div class="alert alert-danger mt-2" v-if="errors.nisn">
                                            {{ errors.nisn }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="">Nama Lengkap</label>
                                        <input type="text" class="form-control" placeholder="Masukkan Nama Siswa" v-model="form.name">
                                        <div class="alert alert-danger mt-2" v-if="errors.name">
                                            {{ errors.name }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="">Kelas</label>
                                        <select class="form-select" v-model="form.classroom_id">
                                            <option v-for="(classroom, index) in classrooms" :key="index" :value="classroom.id">{{ classroom.title }}</option>
                                        </select>
                                        <div class="alert alert-danger mt-2" v-if="errors.classroom_id">
                                            {{ errors.classroom_id }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="">Jenis Kelamin</label>
                                        <select name="" id="" class="form-select" v-model="form.gender">
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        <div class="alert alert-danger mt-2" v-if="errors.gender">
                                            {{ errors.gender }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Password</label> 
                                        <input type="password" class="form-control" placeholder="Masukkan Password" v-model="form.password">
                                        <div v-if="errors.password" class="alert alert-danger mt-2">
                                            {{ errors.password }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label>Konfirmasi Password</label> 
                                        <input type="password" class="form-control" placeholder="Masukkan Konfirmasi Password" v-model="form.password_confirmation">
                                    </div>
                                </div>
                            </div>
                            
                            
                            <button type="submit" class="btn btn-md btn-primary border-0 shadow me-2">Simpan</button>
                            <button type="reset" class="btn btn-md btn-warning border-0 shadow">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    // import layout
    import LayoutAdmin from '../../../Layouts/Admin.vue';

    // import Head and Link from Inertia
    import { Head, Link } from "@inertiajs/inertia-vue3";

    // import reactive from vue
    import { reactive } from "vue";

    // import inertia adapter
    import { Inertia } from "@inertiajs/inertia";

    // import sweet alert2
    import Swal from 'sweetalert2'

    export default {

        // layout
        layout: LayoutAdmin,

        // register components
        components: {
            Head,
            Link
        },

        // props
        props: {
            errors: Object,
            classrooms: Array,
        },

        // inisialisasi composition API
        setup() {

            // define form with reactive
            const form = reactive({
                nisn: '',
                name: '',
                classroom_id: '',
                gender: '',
                password: '',
                password_confirmation: '',
            });

            // method "submit"
            const submit = () => {

                // send data to server
                Inertia.post('/admin/students', {
                    // data
                    nisn: form.nisn,
                    name: form.name,
                    classroom_id: form.classroom_id,
                    gender: form.gender,
                    password: form.password,
                    password_confirmation: form.password_confirmation
                }, {
                    onSuccess: () => {
                        // show success alert
                        Swal.fire({
                            title: 'Success!',
                            text: 'Siswa Berhasil Disimpan',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    },
                });
            }

            // return
            return {
                form,
                submit
            }
        }
    }

</script>