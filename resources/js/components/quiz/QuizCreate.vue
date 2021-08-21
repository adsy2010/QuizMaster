<template>

    <div>
        <QuizForm></QuizForm>
        <QuizQuestionList></QuizQuestionList>
    </div>

</template>

<script>
import QuizForm from "./QuizForm";
import QuizQuestionList from "./QuizQuestionList";
export default {
    name: "QuizCreate",
    components: {QuizQuestionList, QuizForm}
}
</script>

<style scoped>

</style>
