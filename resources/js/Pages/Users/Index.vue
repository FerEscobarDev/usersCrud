<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users List</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-min mx-auto px-3 sm:px-6 lg:px-8 bg-white overflow-hidden">
                <div class="p-6 text-gray-900 flex justify-between items-center">
                    
                    <TextInput
                        id="search"
                        type="string"
                        class="w-1/2 md:w-72 p-2 border"
                        v-model="form.search"
                        placeholder="Search"
                    />
                    <Link 
                        :href="route('user.create')"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        Create User
                        </Link>
                </div>
                <div class="overflow-x-auto shadow-sm sm:rounded-lg mb-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nombres</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs hidden md:table-cell font-medium text-gray-500 uppercase tracking-wider">Apellidos</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cédula</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs hidden lg:table-cell font-medium text-gray-500 uppercase tracking-wider">País</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs hidden xl:table-cell font-medium text-gray-500 uppercase tracking-wider">Dirección</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs hidden md:table-cell font-medium text-gray-500 uppercase tracking-wider">Celular</th>                                
                                <th scope="col" class="px-6 py-3 text-center text-xs hidden sm:table-cell font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                            </tr>
                        </thead>
                        <tbody class="min-w-full divide-y divide-gray-200">
                            <tr v-for="user in users.data" :key="user.id" class="odd:bg-white even:bg-gray-100 hover:bg-blue-100">
                                <td class="text-center text-xs font-semibold px-6 py-4 whitespace-nowrap">
                                    <Link class="flex items-center focus:text-blue-500" :href="route('user.edit', user.id)">
                                        {{ user.name }}
                                    </Link>
                                </td><td class="text-center text-xs hidden md:table-cell font-semibold px-6 py-4 whitespace-nowrap">
                                    <Link class="flex items-center focus:text-blue-500" :href="route('user.edit', user.id)">
                                        {{ user.lastname }}
                                    </Link>
                                </td><td class="text-center text-xs font-semibold px-6 py-4 whitespace-nowrap">
                                    <Link class="flex justify-center items-center focus:text-blue-500" :href="route('user.edit', user.id)">
                                        {{ user.cedula }}
                                    </Link>
                                </td><td class="text-center text-xs font-semibold px-6 py-4 whitespace-nowrap">
                                    <Link class="flex justify-center items-center focus:text-blue-500" :href="route('user.edit', user.id)">
                                        {{ user.email }}
                                    </Link>
                                </td><td class="text-center text-xs hidden lg:table-cell font-semibold px-6 py-4 whitespace-nowrap">
                                    <Link class="flex justify-center items-center focus:text-blue-500" :href="route('user.edit', user.id)">
                                        {{ user.country }}
                                    </Link>
                                </td><td class="text-center text-xs hidden xl:table-cell font-semibold px-6 py-4 whitespace-nowrap">
                                    <Link class="flex items-center focus:text-blue-500" :href="route('user.edit', user.id)">
                                        {{ user.address }}
                                    </Link>
                                </td><td class="text-center text-xs hidden md:table-cell font-semibold px-6 py-4 whitespace-nowrap">
                                    <Link class="flex justify-center items-center focus:text-blue-500" :href="route('user.edit', user.id)">
                                        {{ user.mobil }}
                                    </Link>
                                </td><td class="text-center text-xs hidden sm:table-cell font-semibold px-6 py-4 whitespace-nowrap">
                                    <Link class="flex justify-center items-center focus:text-blue-500" :href="route('user.edit', user.id)">
                                        {{ user.category.name }}
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination v-if="users.data" :paginating="users"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';

export default {
    components: {
        AuthenticatedLayout,
        Head,
        PrimaryButton,
        TextInput,
        Link,
        Pagination,
    },
    props: {
        users: {
            type: Object,
            required: true, 
        },
    },
    data() {
        return {
            form: useForm({
                search: '',
            }),
        }
    },
    methods: {
        search() {
            console.log('ejecutado')
            this.form.get('/', { preserveState: true })
        }
    },
    watch: {
        'form.search': 'search',
        
    },
}
</script>
