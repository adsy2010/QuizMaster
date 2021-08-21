<template>
    <div>
        <b-form-group
            label="name"
        >
            <b-input v-model="name"></b-input>
        </b-form-group>
    </div>
</template>

<script>
export default {
    name: "QuizForm",
    data() {
        return {
            name: '',
        }
    }
}
</script>
