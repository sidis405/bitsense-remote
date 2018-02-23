<template>
    <table class="table my-4">
        <tr>
            <th>Title</th>
            <th>Body</th>
            <th>Author</th>
            <th>Date</th>
        </tr>
        <SinglePost v-for="post in posts.data" :post="post" :key="post.id"></SinglePost>
    </table>
</template>

<script>

    import SinglePost from './SinglePost.vue';

    export default{

        components: {
            SinglePost
        },

        props: ['posts']

    }
</script>
