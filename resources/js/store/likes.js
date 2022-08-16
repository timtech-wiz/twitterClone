import axios from 'axios'
import { without } from 'lodash'
export default{
    namespaced:true,

    state:{
        likes:[]
    },

    getters:{
        likes(state){
            return state.likes
        }
    },

    mutations:{
        PUSH_LIKES(state, data){
            state.likes.push(...data)
        },

        PUSH_LIKE(state, id){
            state.likes.push(id)
        },

        POP_LIKES(state, id){
            state.likes = without(state.likes, id)
        },

    },

    actions:{
        async likeTweet(_, tweet){
            await axios.post(`/api/tweets/${tweet.id}/like`)
        },

        async unlikeTweet(_, tweet){
            await axios.delete(`/api/tweets/${tweet.id}/like`)
        },

        syncLikes({commit, state}, id){
            if(state.likes.includes(id)){
                commit('POP_LIKES', id)
                return
            }
            commit('PUSH_LIKE', id)
        }
    }


}