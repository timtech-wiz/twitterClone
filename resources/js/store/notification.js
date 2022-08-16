import axios from 'axios'
import getters from './tweet/getters'
import mutations from './tweet/mutations'
import actions from './tweet/actions'
export default{
    namespaced:true,
    state:{
        notification: [],
        tweets:[]
    },

    getters:{
        ...getters,
        notification(state){
            return state.notification
        },
        getTweetIdFromNotification(state){
            return state.notification.map(n => n.data.tweet.id)
        }
    },

    mutations:{
        ...mutations,
        PUSH_NOTIFICATIONS(state, data){
            state.notification.push(...data)
        }
    },

    actions:{
        ...actions,
        async getNotifications({commit, dispatch, getters}, url){
          
            let response = await axios.get(url);

            commit('PUSH_NOTIFICATIONS', response.data.data)

            dispatch('getTweets', `api/tweets?ids=${getters.getTweetIdFromNotification.join(',') }`)
             
            return response

            
        }
    }
    
}