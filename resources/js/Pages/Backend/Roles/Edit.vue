<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import VueMultiselect from 'vue-multiselect'

import Table from '@/Components/Table.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableDataCell from '@/Components/TableDataCell.vue';


const props = defineProps({
    role: {
        type: Object,
        required: true,
    },
    permissions: Array,
});

const form = useForm({
    name: props.role.name,
    permissions: [],
});



</script>

<template>
    <AuthenticatedLayout>
        <Head title="Roles Create" />
        <div class="py-12">
            <div class="max-w-6xl mx-auto bg-slate-100">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 pt-4 pb-12">
                        <form @submit.prevent="form.put(route('roles.update', role.id))">
                           <div>
                             <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    placeholder="Role name"
                                    autofocus
                                    autocomplete="name"
                                />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                            <div class="mt-4">
                                <InputLabel for="permissions" value="Permissions" />

                                <VueMultiselect
                                v-model="form.permissions"
                                :options="permissions"
                                :multiple="true"
                                :close-on-select="true"
                                placeholder="Select permissions"
                                label="name"
                                track-by="id"
                              />
                                <InputError class="mt-2" :message="form.errors.permissions" />
                            </div>
                           </div>

                            <div class="flex items-center justify-end mt-4">
                                <Link
                                    :href="route('roles.index')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                   Back
                                </Link>

                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Update
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="max-w-6xl mx-auto mt-6 bg-slate-100">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="">
                            <Table>
                                <template #header>
                                    <TableHeaderCell>ID</TableHeaderCell>
                                    <TableHeaderCell>Name</TableHeaderCell>
                                    <TableHeaderCell>Action</TableHeaderCell>
                                </template>
                                <template #default>
                                    <TableRow v-for="permission in role.permissions" :key="permission.id" class="border-b">
                                        <TableDataCell>{{ permission.id }}</TableDataCell>
                                        <TableDataCell>{{ permission.name }}</TableDataCell>
                                        <TableDataCell class="flex space-x-2">
                                            <Link method="DELETE" as="button" :href="route('permissions.destroy', permission.id)" class="">Revoke</Link>
                                        </TableDataCell>
                                    </TableRow>
                                </template>
                            </Table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
