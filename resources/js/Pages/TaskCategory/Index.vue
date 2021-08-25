<template>
    <authenticated>
        <flash-messages />
        <div class="flex m-10">
            <div class="w-full">
                <h1 class="text-2xl md:text-3xl font-bold">
                    Task Categories List
                </h1>
            </div>
        </div>
        <div class="m-10">
            <!-- This example requires Tailwind CSS v2.0+ -->
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            scope="col"
                            class="
                                px-6
                                py-3
                                text-left text-xs
                                font-medium
                                text-gray-500
                                uppercase
                                tracking-wider
                            "
                        >
                            Sr.No.
                        </th>
                        <th
                            scope="col"
                            class="
                                px-6
                                py-3
                                text-left text-xs
                                font-medium
                                text-gray-500
                                uppercase
                                tracking-wider
                            "
                        >
                            Category Name
                        </th>
                        <th
                            scope="col"
                            class="
                                px-6
                                py-3
                                text-left text-xs
                                font-medium
                                text-gray-500
                                uppercase
                                tracking-wider
                            "
                        >
                            Status
                        </th>
                        <th
                            colspan="2"
                            scope="col"
                            class="
                                px-6
                                py-3
                                text-center text-xs
                                font-medium
                                text-gray-500
                                uppercase
                                tracking-wider
                            "
                        >
                            Actions
                        </th>
                        <!-- <th scope="col" class="relative px-6 py-3">
              <span class="sr-only">Edit</span>
            </th> -->
                    </tr>
                </thead>
                <tbody
                    v-if="categories.length"
                    class="bg-white divide-y divide-gray-200"
                >
                    <tr v-for="(category, index) in categories" :key="index">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                {{ index + 1 }}.
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ category.name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                v-if="category.status == 1"
                                class="
                                    px-2
                                    inline-flex
                                    text-xs
                                    leading-5
                                    font-semibold
                                    rounded-full
                                    bg-green-100
                                    text-green-800
                                "
                            >
                                Active
                            </span>
                            <span
                                v-else
                                class="
                                    px-2
                                    inline-flex
                                    text-xs
                                    leading-5
                                    font-semibold
                                    rounded-full
                                    bg-red-100
                                    text-red-800
                                "
                            >
                                Deactive
                            </span>
                        </td>
                        <td
                            class="
                                px-6
                                py-4
                                text-center
                                whitespace-nowrap
                                text-sm text-gray-500
                            "
                        >
                            <button
                                @click="editCategory(category.id)"
                                class="text-indigo-600 hover:text-indigo-900"
                            >
                                Edit
                            </button>
                        </td>
                        <td
                            class="
                                px-6
                                py-4
                                text-center
                                whitespace-nowrap
                                text-sm
                                font-medium
                            "
                        >
                            <button
                                @click="deleteCategory(category.id)"
                                class="text-indigo-600 hover:text-indigo-900"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                    <!-- More people... -->
                </tbody>
                <tbody v-else class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap">
                            No Data Found.
                        </td>
                    </tr>
                    <!-- More people... -->
                </tbody>
            </table>
        </div>
    </authenticated>
</template>
<script>
import FlashMessages from "@/Shared/FlashMessages";
import Authenticated from "@/Layouts/Authenticated.vue";
export default {
    components: {
        Authenticated,
        FlashMessages,
    },
    props: {
        categories: Array,
        success: Object,
    },
    methods: {
        editCategory(id) {
            this.$inertia.visit(this.route("taskCategory.edit", id));
        },
        deleteCategory(id) {
            this.$inertia
                .delete(this.route("taskCategory.destroy", id))
                .then(() => {
                    console.log("hello");
                });
        },
    },
};
</script>
