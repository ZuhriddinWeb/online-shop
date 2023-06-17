import { computed , ref} from "vue"

export function Init(selectedUser = null, lastPeriod){
    const totalPrice = ref(null)
    const user = ref(null)
    const period = ref(lastPeriod)

    function changePeriod(){
        totalPrice.value = null
        if(selectedUser) getSelectedPeoples(period.value, selectedUser)
        else getPeoples(period.value)
    }

    function recursiya(data) {
        data.forEach((user) => {
            user.name = user.fname
            if(user.level == 1) getProcent(user, 11)
            if(user.level == 2 && levels.value > 1) getProcent(user, 11)
            if(user.level == 3 && levels.value > 2) getProcent(user, 10)
            if(user.level == 4 && levels.value > 3) getProcent(user, 10)
    
            if(user.level == 5 && levels.value > 4) getProcent(user, 8)
            if(user.level == 6 && levels.value > 5) getProcent(user, 8)
            if(user.level == 7 && levels.value > 6) getProcent(user, 8)
    
            if(user.level == 8 && levels.value > 7) getProcent(user, 7)
            if(user.level == 9 && levels.value > 8) getProcent(user, 7)
            
            user.children = user.children.filter((element) => user.id == element.parent_id)
            user.childrenCount = user.children.length
            recursiya(user.children)
        })
    }

    function getPeoples(period = null) {
        axios.get(`getusers/${period}`).then(({ data }) => {
            user.value = data
            recursiya(data.children)
        })
    }

    function getSelectedPeoples(period = null, selectedUser) {
        axios.get(`getusers/${period}/${selectedUser}`).then(({data}) => {
            user.value = data
            recursiya(data.children)
        })
    }

    if(selectedUser) getSelectedPeoples(period.value, selectedUser)
    else getPeoples(period.value)
    

    const levels = computed(() => {
        const activeUsers = user.value?.children.filter((user) => user.total >= 30).length
        const userSumma = user.value?.total
        const levelUp = getLevelUp()
    
        if(activeUsers >= 9 && userSumma >= 5000 && levelUp == 9) return 9
    
        else if(activeUsers >= 8 && userSumma >= 2500 && levelUp >= 8) return 8
    
        else if(activeUsers >= 7 && userSumma >= 1200 && levelUp >= 7) return 7
    
        else if(activeUsers >= 6 && userSumma >= 600 && levelUp >= 6) return 6
    
        else if(activeUsers >= 5 && userSumma >= 250 && levelUp >= 5) return 5
    
        else if(activeUsers >= 4 && userSumma >= 120 && levelUp >= 4) return 4
    
        else if(activeUsers >= 3 && userSumma >= 60) return 3
        else if(activeUsers >= 2) return 2
    
        else if(activeUsers >= 1) return 1
        else return 1
    })

    function getProcent(user, cent){
        var prosent = (+user.total/100)*cent
        user.procent = Math.round(prosent * 100)/100/2
        totalPrice.value += user.procent
    }

    function getLevelUp(){
        var levelUp = 0
        user.value?.children.forEach((user,index, some) => {
            if(some.length > 4 && some.filter((user) => user.summaBranch >= 25000).length > 4){
                levelUp = 9
            }
            else if(some.length > 3 && some.filter((user) => user.summaBranch >= 5000).length > 3){
                levelUp = 8
            }
            else if(some.length >= 3 && some.filter((user) => user.summaBranch >= 2000).length >= 3){
                levelUp = 7
            }
            else if(some.length >= 3 && some.filter((user) => user.summaBranch >= 600).length >= 3){
                levelUp = 6
            }
            else if(some.length >= 2 && some.filter((user) => user.summaBranch >= 300).length >= 2){
                levelUp = 5
            }
            else if(some.length >= 2 && some.filter((user) => user.summaBranch >= 100).length >= 2){
                levelUp = 4
            }
        })
        return levelUp
    }

    return { levels, totalPrice, user , period , changePeriod, getSelectedPeoples }
}