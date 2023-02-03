<template>
    <Head>
        <title>Edit Kelas</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row">
            <div class="col-md-12">
                <Link class="btn btn-md btn-primary border-0 shadow mb-3" href="/admin/classrooms" type="button"><i class="fa fa-long-arrow-alt-left me-2"></i>Kembali</Link>
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5><i class="fa fa-clone"></i>Edit Kelas</h5>
                        <hr>
                        <form @submit.prevent="submit" action="">
                            <div class="mb-4">
                                <label for="">Name Kelas</label>
                                <input type="text" name="" id="" class="form-control" v-model="form.title" placeholder="Masukkan Name Kelas">

                                <div class="alert alert-danger mt-2" v-if="errors.title">
                                    {{ errors.title }}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-md btn-primary border-0 shadow me-2">Update</button>
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

        // register componenets
        components: {
            Head,
            Link
        },

        // props
        props: {
            errors: Object,
            classroom: Object,
        },

        // inisialisasi composition API
        setup(props) {

            // define form with reactive
            const form = reactive({
                title: props.classroom.title,
            });

            // method "submit"
            const submit = () => {

                // send data to server
                Inertia.put(`/admin/classrooms/${props.classroom.id}`, {
                    // data
                    title: form.title,
                }, {
                    onSuccess: () => {
                        // show succuss alert
                        Swal.fire({
                            title: 'Success!',
                            text: 'Kelas Berhasil Diupdate!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    },
                });
            }

            return {
                form,
                submit
            }
        }
    }

</script>