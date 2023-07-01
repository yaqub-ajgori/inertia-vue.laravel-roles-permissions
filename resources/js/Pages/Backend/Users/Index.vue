<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

import Table from '@/Components/Table.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableDataCell from '@/Components/TableDataCell.vue';

defineProps(['users']);



</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
             <h2 class="font-semibold text-xl text-gray-800 leading-tight">All Users</h2>
             <Link
             :href="route('users.create')"
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
                                <TableHeaderCell>Email</TableHeaderCell>
                                <TableHeaderCell>Created at</TableHeaderCell>
                                <TableHeaderCell>Action</TableHeaderCell>
                            </template>
                            <template #default>
                                <TableRow v-for="user in users" :key="user.id" class="border-b">
                                    <TableDataCell>{{ user.id }}</TableDataCell>
                                    <TableDataCell>{{ user.name }}</TableDataCell>
                                    <TableDataCell>{{ user.email }}</TableDataCell>
                                    <TableDataCell>{{ user.created_at }}</TableDataCell>
                                    <TableDataCell class="flex space-x-2">
                                        <Link
                                            :href="route('users.edit', user.id)"
                                            as="button"
                                            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-800 text-white shadow-sm rounded-lg text-sm">
                                            Edit
                                        </Link>
                                        <Link method="DELETE" as="button" :href="route('users.destroy', user.id)" class="px-5 py-2 bg-red-600 hover:bg-red-800 text-white shadow-sm rounded-lg text-sm">Delete</Link>
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
