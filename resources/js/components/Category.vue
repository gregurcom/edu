<template>
    <div class="container wrapper flex-grow-1 mt-5 mb-3">
        <div v-for="category in categories">
            <h2 class="mt-5">
                <a :href="`/categories/${category.id}/courses`" class="text-dark text-decoration-none head-link">{{ category.name }}</a>
            </h2>
            <div class="mt-4">
                <div class="mt-3" v-for="course in category.courses">
                    <div class="row">
                        <div class="col-md-8">
                            <ul>
                                <li>
                                    <a :href="`/courses/${course.id}`" class="text-decoration-none text-dark h3">{{ course.title }}</a>
                                    <span class="h4 px-2">(<a href="#" class="text-decoration-none text-dark">{{ course.author }}</a>)</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 d-flex">
                            <div class="px-3">
                                <span v-for="i in 5">
                                    <span v-if="Math.round(course.rate) >= i"><i class="star fa fa-star"></i></span>
                                    <span v-else><i class="star fa fa-star-o"></i></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: [],
            }
        },
        mounted() {
            axios.get('api/v1/categories').then(response => {
                this.categories = response.data.data
            })
        },
    }
</script>
