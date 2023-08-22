<template>
        <div>
            <div class="navbar">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <router-link to="/"><span class="wi-nav-icon"><Icon type="ios-home" /></span>Home</router-link>
                    </div>
                   
                    <div class="col-md-6 col-sm-6 col-xs-6" >
                        <router-link to="/mine"><span class="wi-nav-icon"><Icon type="ios-contact-outline" /></span>Profile</router-link>
                    </div>
                   
                </div>
            </div>
            <div>
                <router-view/>
            </div>
      </div>
</template>
<script>
export default {
    
}
</script>