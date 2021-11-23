<template>
    <div class="card my-3">
        <h5 class="card-header">{{post.title}}</h5>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text">{{post.content}}</p>
            <p class="card-text">{{post.post_date}}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PostCard',

    props: {
        'post' : Object,
    }
}
</script>

<style>

</style>