<template>
    <form class="col-12 col-lg-4">
        <label for="bio" class="block text-sm font-medium text-gray-700">
            Про себе
        </label>
        <textarea name="bio" id="bio" cols="30" rows="7" class="form-control mt-1" v-model="user.bio">{{ user.bio }}</textarea>
    </form>

    <!--Update avatar-->
    <div class="col-12 col-lg-4">
        <label for="avatar" class="block text-sm font-medium text-gray-700">
            Аватар
        </label>
        <img :src="avatarPreview" v-if="avatarPreview" alt="Avatar" class="avatar" width="100">
        <img :src="this.user.avatar" v-if="this.user" alt="Avatar" class="avatar" width="100">
        <input type="file" name="avatar" id="avatar" class="form-control mt-1" @change="onAvatarChange">
    </div>

</template>

<script>

export default {
    data() {
        return {
            avatarPreview: this.user.avatar || null
        }
    },
    props: {
        user: {
            type: Object,
            required: true
        }
    },
    methods: {
        onAvatarChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.avatarPreview = URL.createObjectURL(file);
                this.$emit('avatarChanged', file);
            }
        }
    },
    created() {
        console.log(this.avatarPreview);
        this.avatarPreview = this.user.avatar || null;
    }


}
</script>

<style scoped>
.avatar {
    border-radius: 50%;
    margin-top: 10px;
    margin-bottom: 10px;
    display: block;
}
</style>
