<template>
    <tr>
        <td>
            <i class="fa fa-eye"></i>&nbsp;<a href="#">{{ this.localPost.title }}</a>
            <span class="pull-right"><a href="#" @click.prevent="startEdit"><i class="fa fa-edit"></i> Edit</a></span>
        </td>
        <td>{{ this.localPost.body }}</td>
        <td>{{ this.localPost.user.name }}</td>
        <td>{{ this.localPost.created_at}}</td>
    </tr>
</template>

<script>
    export default {

        props: ['post'],

        data(){
            return {
                localPost: this.post
            }
        },

        methods: {
            startEdit(){
                //shows edit form
                //user edit
                //user clicks button
                this.localPost.title = "I have been edited";

                axios.put('/posts/' + this.localPost.slug, {title: this.localPost.title}).then(() => {

                    console.log('Edit Completed')
                });
            }
        }
    }
</script>
