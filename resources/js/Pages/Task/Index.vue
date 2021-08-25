<template>
    <authenticated>
        <flash-messages />
        <div class="flex m-10">
            <div class="w-1/2 sm:w-full">
                <h1 class="text-2xl md:text-3xl font-bold">Task List</h1>
            </div>
            <div class="w-1/2 sm:w-full">
                <form method="get" action="" style="display: inline">
                    <div class="float-right">
                        <label for="pwd"><strong>Filter:&nbsp;</strong></label>
                        <select
                            name="task_category_id"
                            @change="filter($event)"
                        >
                            <option disabled selected>Select Category</option>
                            <option value="">All</option>
                            <option
                                v-for="category in taskCategories"
                                :key="category.id"
                                :value="category.id"
                            >
                                {{ category.name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </form>
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
                    v-if="tasks.length"
                    class="bg-white divide-y divide-gray-200"
                >
                    <tr v-for="(task, index) in tasks" :key="index">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                {{ index + 1 }}.
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ task.name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button
                                v-if="task.is_complete == 1"
                                @click="toggleComplete(task.id)"
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
                                Complete
                            </button>
                            <button
                                v-else
                                @click="toggleComplete(task.id)"
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
                                Incomplete
                            </button>
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
                                @click="editTask(task.id)"
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
                                @click="deleteTask(task.id)"
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
        tasks: Array,
        success: Object,
        taskCategories: Array,
    },
    methods: {
        editTask(id) {
            this.$inertia.visit(this.route("task.edit", id));
        },
        deleteTask(id) {
            this.$inertia.delete(this.route("task.destroy", id)).then(() => {
                console.log("hello");
            });
        },
        toggleComplete(id) {
            this.$inertia
                .put(this.route("task-toggle-complete", id))
                .then(() => {
                    console.log("hello");
                });
        },
        filter(event) {
            const id = event.target.value;
            this.$inertia.visit(this.route("task.index", { id: id }));
        },
    },
};
</script>
