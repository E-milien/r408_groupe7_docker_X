<script setup>
import Tweet from '../components/Tweet.vue'
import { useTweetStore } from '../store/tweet'
import { ref, computed } from 'vue';

const tweetStore = useTweetStore()
tweetStore.getTweets()

const filtre = ref("")

const filteredTweets = computed(() => {
    var tmp = tweetStore.allTweet.filter(tweet => tweet.tweet_text.toLowerCase().indexOf(filtre.value.toLowerCase()) != -1)
    console.log(tmp)
    return tmp
})
</script>

<template>

    <section>
        <div class="container">
            <div class="search-bar">
                <input id="rechercher" type="text" placeholder="Rechercher sur Twitter" v-model="filtre">
            </div>
            <div class="tweet-list">
                <Tweet v-for="tweet in filteredTweets" v-bind:key="tweet.id" :tweet="tweet" />
            </div>
        </div>
    </section>
    <a href="/publish"><img src="../assets/tweet.png" alt="img" class="publish-image"></a>

</template>
<style scoped>
.container {
    /* largeur maximale du contenu */
    margin: 0 auto;
    /* centrage horizontal */
}

.search-bar {
    position: fixed;
    top: 0;
    left: 51.5%;
    transform: translateX(-50%);
    width: calc(100% - 40px);
    /* largeur de la barre de recherche */
    max-width: 700px;
    /* largeur maximale */
    background-color: #fff;
    padding: 15px;
    border-radius: 25px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    z-index: 999;
}

#rechercher {
    width: 150%;
    border: none;
    outline: none;
    font-size: 16px;
}

.tweet-list {
    margin-top: 75px;
    width: 220%;
}

section {
    width: 40%;
    margin-right: 200px;
}

.publish-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #1da1f2;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.publish-button:hover {
    background-color: #1287cf;
}

.publish-image {
    position: fixed;
    bottom: 60px;
    right: 20px;
    width: 70px;
    height: auto;
    cursor: pointer;
}
</style>
