<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Table from '@/Components/Table.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableDataCell from '@/Components/TableDataCell.vue';
import DangerButton from '@/Components/DangerButton.vue';

defineProps(['roles']);



</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
           <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">All Roles</h2>
            <Link
            :href="route('roles.create')"
            as="button"
            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-800 text-white shadow-sm rounded-lg text-sm ">Add New</Link>
           </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="">
                        <Table>
                            <template #header>
                                <TableHeaderCell>ID</TableHeaderCell>
                                <TableHeaderCell>Name</TableHeaderCell>
                                <TableHeaderCell>Created at</TableHeaderCell>
                                <TableHeaderCell>Action</TableHeaderCell>
                            </template>
                            <template #default>
                                <TableRow v-for="role in roles" :key="role.id" class="border-b">
                                    <TableDataCell>{{ role.id }}</TableDataCell>
                                    <TableDataCell>{{ role.name }}</TableDataCell>
                                    <TableDataCell>{{ role.created_at }}</TableDataCell>
                                    <TableDataCell class="flex space-x-2">
                                        <Link
                                            :href="route('roles.edit', role.id)"
                                            as="button"
                                            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-800 text-white shadow-sm rounded-lg text-sm">
                                            Edit
                                        </Link>
                                        <Link method="DELETE" as="button" :href="route('roles.destroy', role.id)" class="px-5 py-2 bg-red-600 hover:bg-red-800 text-white shadow-sm rounded-lg text-sm">Delete</Link>
                                    </TableDataCell>
                                </TableRow>
                            </template>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
