import axios from "axios"
export default {
    async getTweets({ commit }, url){
        let response = await axios.get(url);

        commit('PUSH_TWEETS', response.data.data)
        commit('likes/PUSH_LIKES', response.data.meta.likes, {root:true})
        commit('retweet/PUSH_RETWEETS', response.data.meta.retweets, {root:true})

        return response
    },

    async quoteTweet(_, {tweet, data}){
        await axios.post(`/api/tweets/${tweet.id}/quote`, data)
    },

    async replyTweet(_, {tweet, data}){
        await axios.post(`/api/tweets/${tweet.id}/reply`, data)
    }
}