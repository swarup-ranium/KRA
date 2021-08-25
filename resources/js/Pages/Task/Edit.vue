<template>
    <authenticated>
        <form
            @submit.prevent="add"
            id="add-category"
            class="
                w-full
                mx-auto
                max-w-3xl
                bg-white
                shadow
                p-8
                text-gray-700
                mt-20
            "
        >
            <h2 class="w-full my-2 text-3xl font-bold leading-tight my-5">
                Add Task
            </h2>
            <!-- name field -->
            <div class="flex flex-wrap mb-6">
                <div class="relative w-full appearance-none label-floating">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="name"
                    >
                        Task name:
                    </label>
                    <input
                        v-model="taskName"
                        class="
                            shadow
                            appearance-none
                            border
                            rounded
                            w-full
                            py-2
                            px-3
                            text-gray-700
                            leading-tight
                            focus:outline-none focus:shadow-outline
                        "
                        id="name"
                        type="text"
                        placeholder="Task Name"
                    />
                    <p
                        v-if="errors && errors.name"
                        class="p-2 text-red-500 text-sm italic"
                    >
                        {{ errors.name }}
                    </p>
                </div>
            </div>
            <div class="flex flex-wrap mb-6">
                <div class="relative w-full appearance-none label-floating">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="name"
                    >
                        Category:
                    </label>
                    <select v-model="categoryId">
                        <option :value="null" disabled selected>
                            Select any Category
                        </option>
                        <option
                            v-for="(taskCategory, index) in taskCategories"
                            :value="taskCategory.id"
                            :key="index"
                        >
                            {{ taskCategory.name }}
                        </option>
                    </select>
                    <p
                        v-if="errors && errors.name"
                        class="p-2 text-red-500 text-sm italic"
                    >
                        {{ errors.categoryId }}
                    </p>
                </div>
            </div>
            <div class="flex flex-wrap mb-6">
                <div class="relative w-full appearance-none label-floating">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="name"
                    >
                        Is Complete:
                    </label>
                    <select v-model="isComplete">
                        <option :value="null" disabled selected>
                            Select any Category
                        </option>
                        <option :value="1">Complete</option>
                        <option :value="0">Incomplete</option>
                    </select>
                </div>
            </div>
            <div class="pb-10 pl-0"></div>
            <div class="">
                <button
                    class="
                        w-20
                        shadow
                        bg-gray-800
                        hover:bg-teal-400
                        focus:shadow-outline focus:outline-none
                        text-white
                        font-bold
                        py-2
                        px-4
                        rounded
                    "
                    type="submit"
                >
                    Update
                </button>
            </div>
        </form>
    </authenticated>
</template>
<script>
import Authenticated from "@/Layouts/Authenticated.vue";
export default {
    components: {
        Authenticated,
    },
    props: {
        task: Object,
        taskCategories: Object,
        errors: Object,
    },
    data() {
        return {
            taskName: this.task ? this.task.name : null,
            categoryId: this.task ? this.task.category_id : null,
            isComplete: this.task ? this.task.is_complete : null,
        };
    },
    methods: {
        add() {
            this.$inertia.put(this.route("task.update", this.task.id), {
                name: this.taskName,
                categoryId: this.categoryId,
                isComplete: this.isComplete,
            });
        },
    },
};
</script>
<style>
/* RED BORDER ON INVALID INPUT */
.check input:invalid {
    border-color: red;
}

/* FLOATING LABEL */
.label-floating input:not(:placeholder-shown),
.label-floating textarea:not(:placeholder-shown) {
    padding-top: 1.4rem;
}
.label-floating input:not(:placeholder-shown) ~ label,
.label-floating textarea:not(:placeholder-shown) ~ label {
    font-size: 0.8rem;
    transition: all 0.2s ease-in-out;
    color: #1f9d55;
    opacity: 1;
}
</style>
