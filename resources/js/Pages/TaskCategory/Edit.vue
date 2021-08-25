<template>
    <authenticated>
        <form
            @submit.prevent="update"
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
                Edit Category
            </h2>
            <!-- name field -->
            <div class="flex flex-wrap mb-6">
                <div class="relative w-full appearance-none label-floating">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="categoryname"
                    >
                        Category name
                    </label>
                    <input
                        v-model="catName"
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
                        id="categoryname"
                        type="text"
                        placeholder="Category Name"
                    />
                    <p
                        v-if="errors && errors.name"
                        class="p-2 text-red-500 text-sm italic"
                    >
                        {{ errors.name }}
                    </p>
                </div>
            </div>
            <div class="pb-10 pl-0">
                <select v-model="status">
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                </select>
            </div>
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
        categoryDetails: Object,
        errors: Object,
    },
    data() {
        return {
            status: this.categoryDetails ? this.categoryDetails.status : null,
            catName: this.categoryDetails ? this.categoryDetails.name : null,
        };
    },
    methods: {
        update() {
            this.$inertia.put(
                this.route("taskCategory.update", this.categoryDetails.id),
                {
                    name: this.catName,
                    status: this.status,
                }
            );
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
