<template>

    <div class="left__menu"  :class="{active : isActive}">
        <nav><img src="" alt="">
            <div class="logo"></div>
            <ul>
                <li><router-link to="/" @click="toggleMenus">Главная</router-link></li>
                <li><router-link to="/predictions" @click="toggleMenus">Прогнозы</router-link></li>
                <li><router-link to="/archive" @click="toggleMenus">Архив</router-link></li>
                <li><router-link to="/chat" @click="toggleMenus">Duospec</router-link></li>
          
            </ul>
        </nav>
     
    </div>
    <!-- <div class="hamburger" id="hamb" :class="isActive ? 'active' : ''"  @click="toggleMenus" > -->
    <div class="hamburger" id="hamb" :class="{active : isActive}" @click="toggleMenus" >
            <span></span>
            <span></span>
            <span></span>
        </div>
    </template>
    
    
    <script setup>
 import { ref } from 'vue'

const   isActive = ref(false);

function toggleMenus() {
              isActive.value = !isActive.value;
            
            }



    
    </script>
    
    
    <style lang="scss">

$test:#fff;

    .left__menu {
        position: fixed;
        padding-top: 20px;
        top: 0;
        left: -280px;
        /* padding: 30px; */
        height: 100vh;
        transition: all .2s ease;
        background-color: #161616;
        &.active {
            left: 0;
        }
        .router-link-active {
    &::after {
        content: '';
        width: 100%;
    }
}




    }
    .left__menu a {
        height: 50px;
        display: block;
        /* margin-bottom: 10px; */
        color: #fff;
        position: relative;
        z-index: 1002;
        font-weight: 300;
        padding-right: 80px;
        padding-left: 30px;
        font-size: 30px;
        border-bottom: 1px solid #333;
    }

    .left__menu a::before {
        content: '';
        width: 10px;
        height: 50px;
        background-color: #2c2c2c;
        top: 0;
        left: 0;
        position: absolute;
        z-index: 1001;
        
    }
    .left__menu a::after {
        content: '';
        width:0;
        transition: all .3s ease;
        position: absolute;top: 0;
        z-index: inherit;
        height: 50px;
        left: 9px;
        z-index:-1;
        background: linear-gradient(90deg, rgba(44,44,44,1) 0%, rgba(44,44,44,0.15) 100%);
    
    }
    .left__menu a:hover::after {
        width: 100%;
    }

    .hamburger {
    cursor: pointer;
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 1000;
        span {
            background: #fff;
    border-radius: 4px;
    display: flex;
    height: 4px;
    margin: 4px auto;
    transition: all .2s ease;
    width: 29px; 
        }
        &.active {
            span:first-child {
    transform: translateY(7px) rotate(45deg);
}
span:nth-child(2) {
    display: none;
}
span:nth-child(3) {
    transform: translateY(-2px) rotate(-45deg);
}


        }
    }
 

    </style>