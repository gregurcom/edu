<template>
    <div v-if="loading === false">
        <div class="text-center">
            <img :src="'/images/smile.png'" width="600" height="300" id="course-image">
        </div>
        <span v-for="category in categories" class="px-2">
            <a :href="`/categories/${category.id}/courses`" class="btn btn-outline-dark mt-2">{{ category.name }}</a>
        </span>
    </div>
    <div v-else class="atom">
        <atom-spinner
            :animation-duration="1000"
            :size="80"
            :color="'#69d2f1'"
        />
    </div>
</template>

<script>
    import {AtomSpinner} from 'epic-spinners'
    export default {
        components: {
            AtomSpinner
        },
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
