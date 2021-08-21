<template>
    <div>
        <b-form-group label="Question">
            <b-input v-model="question"></b-input>
        </b-form-group>

        <b-row>
            <b-col>
                <b-form-group label="Answer 1">
                    <b-input-group>
                        <b-input v-model="answer1"></b-input>
                    </b-input-group>
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Answer 2">
                    <b-input-group>
                        <b-input-group-prepend is-text>
                            <input v-model="answer2Enabled" type="checkbox" aria-label="Enable answer 2">
                        </b-input-group-prepend>
                        <b-input v-model="answer2" :disabled="!answer2Enabled"></b-input>
                    </b-input-group>
                </b-form-group>
            </b-col>
        </b-row>

        <b-row>
            <b-col>
                <b-form-group label="Answer 3">
                    <b-input-group>
                        <b-input-group-prepend is-text>
                            <input v-model="answer3Enabled" :disabled="!answer2Enabled" type="checkbox" aria-label="Enable answer 3">
                        </b-input-group-prepend>
                        <b-input v-model="answer3" :disabled="!answer3Enabled"></b-input>
                    </b-input-group>
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Answer 4">
                    <b-input-group>
                        <b-input-group-prepend is-text>
                            <input v-model="answer4Enabled" :disabled="!answer3Enabled" type="checkbox" aria-label="Enable answer 4">
                        </b-input-group-prepend>
                        <b-input v-model="answer4" :disabled="!answer4Enabled"></b-input>
                    </b-input-group>
                </b-form-group>
            </b-col>
        </b-row>

    </div>
</template>

<script>
export default {
    name: "QuestionForm",
    data() {
        return {
            question: '',
            answer1: '',
            answer2: '',
            answer3: '',
            answer4: '',
            answer2Enabled: false,
            answer3Enabled: false,
            answer4Enabled: false,
        }
    }
}
</script>
