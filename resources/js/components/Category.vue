<template>
    <div :class="{'loading': loading}">
        <span v-for="category in categories" class="px-3">
            <a :href="`/categories/${category.id}/courses`" class="btn btn-outline-dark">{{ category.name }}</a>
        </span>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: [],
                loading: true,
            }
        },
        mounted() {
            axios.get('api/v1/categories').then(response => {
                this.categories = response.data.data
                this.loading = false
            })
        },
    }
</script>
