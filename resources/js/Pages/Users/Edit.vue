<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <Link class="text-blue-400 hover:text-blue-600" :href="route('user.index')">Users</Link>
                    <span class="text-blue-400 font-medium">/</span>
                    {{ user.data.name }} {{ user.data.lastname }}
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl w-full mx-auto pt-6 px-3 sm:px-6 lg:px-8 bg-white overflow-hidden rounded-lg">
                <div class="overflow-x-auto shadow-sm">
                    <form @submit.prevent="submit" class="w-full flex flex-wrap">
                        <div class="w-full lg:w-1/2 p-3">
                            <InputLabel for="name" value="Nombres" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                autocomplete="name"
                            />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="w-full lg:w-1/2 p-3">
                            <InputLabel for="lastname" value="Apellidos" />

                            <TextInput
                                id="lastname"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.lastname"
                                autocomplete="lastname"
                            />

                            <InputError class="mt-2" :message="form.errors.lastname" />
                        </div>
                        <div class="w-full lg:w-1/2 p-3">
                            <InputLabel for="cedula" value="Cédula" />

                            <TextInput
                                id="cedula"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.cedula"
                                autocomplete="cedula"
                            />

                            <InputError class="mt-2" :message="form.errors.cedula" />
                        </div>
                        <div class="w-full lg:w-1/2 p-3">
                            <InputLabel for="cedula" value="País" />
                            <!-- <SelectInput :selectList="countries" :selectValue="form.country" v-model="form.country"/> -->

                            <select name="country" id="country" @change="onChangeCountry($event)" class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm mt-1 block w-full">
                                <option v-for="country in countries" :key="country" :value="country" :selected="form.country === country">{{ country }}</option>
                            </select>

                            <InputError class="mt-2" :message="form.errors.country" />
                        </div>
                        <div class="w-full lg:w-1/2 p-3">
                            <InputLabel for="address" value="Dirección" />

                            <TextInput
                                id="address"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.address"
                                autocomplete="address"
                            />

                            <InputError class="mt-2" :message="form.errors.address" />
                        </div>
                        <div class="w-full lg:w-1/2 p-3">
                            <InputLabel for="mobil" value="Celular" />

                            <TextInput
                                id="mobil"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.mobil"
                                autocomplete="mobil"
                            />

                            <InputError class="mt-2" :message="form.errors.mobil" />
                        </div>
                        <div class="w-full lg:w-1/2 p-3">
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                autocomplete="email"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                        <div class="w-full lg:w-1/2 p-3">
                            <InputLabel for="category_id" value="Categoría" />

                            <select name="category_id" id="category_id" @change="onChangeCategory($event)" class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm mt-1 block w-full">
                                <option v-for="category in categories.data" :key="category.id" :value="category.id" :selected="form.category_id === category.id">{{ category.name }}</option>
                            </select>
                            <!-- <TextInput
                                id="category"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.category_id"
                                autocomplete="category"
                            /> -->

                            <InputError class="mt-2" :message="form.errors.catcategory_idegory" />
                        </div>
                        <div class="w-full flex justify-between items-center px-6 pt-3 pb-6">
                            <button class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy()">Delete User</button>
                            <PrimaryButton>Actualizar</PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

export default {
    components: {
        AuthenticatedLayout,
        Head,
        PrimaryButton,
        TextInput,
        InputLabel,
        InputError,
        Link,
    },
    props: {
        user: {
            type: Object,
            required: true, 
        },
        categories: {
            type: Object,
            required: true, 
        },
    },
    data() {
        return {
            form: useForm({
                _method: 'PUT',                
                category_id: this.user.data.category.id,
                name: this.user.data.name,
                lastname: this.user.data.lastname,
                cedula: Number(this.user.data.cedula),
                country: this.user.data.country,
                address: this.user.data.address,
                mobil:  Number(this.user.data.mobil),
                email: this.user.data.email,
            }),
            countries: ['Seleccione'],
        }
    },
    created () {
        this.getCountries();
    },
    methods: {
        submit(){
            this.form.post(route('user.update', this.user.data.id), {
                errorBag: 'user.update',
                preserveScroll: true,
            });
        },

        async getCountries(){
            await axios.get('https://restcountries.com/v3.1/region/americas').then(response => {

                this.countries = response.data.map(({translations}, index) => {
                    return translations.spa.official
                });
            });
        },

        onChangeCountry(event){
            this.form.country = event.target.value;
        },

        onChangeCategory(event){
            this.form.category_id = Number(event.target.value);
        },

        destroy(){
            const form = useForm({ _method: 'DELETE' })
            form.post(route('user.destroy', this.user.data.id), {
                errorBag: 'user.destroy',
                preserveScroll: true,
            });
        }
    },
}
</script>