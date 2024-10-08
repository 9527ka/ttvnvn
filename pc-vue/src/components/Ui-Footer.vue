<template>
    <footer class="footer">
        <div class="pc" v-if="isSidebarVisible">
            <div class="footer_le">
                <img class="footer_le_logo" src="@/assets/footer/batlogo.png" alt="">
                <div class="footer_le_app">
                    <a href="https://www.linkedin.com/" target="_blank"><img src="../assets/footer/I.png"></a>
                    <a href="https://x.com/i/flow/login" target="_blank"><img src="../assets/footer/T.png"></a>
                    <a href="https://www.facebook.com/" target="_blank"><img src="../assets/footer/F.png"></a>
                    <a href="https://www.tiktok.com/en/" target="_blank"><img src="../assets/footer/D.png"></a>
                    <a href="https://www.youtube.com/" target="_blank"><img src="../assets/footer/Y.png"></a>
                    <a href="https://www.instagram.com/" target="_blank"><img src="../assets/footer/IN.png"></a>
                </div>
            </div>
            <div class="footer_ce">
                <div class="footer_ce_ti">Liên kết nhanh</div>
                <div class="footer_ce_p">
                    <p><a href="/company">Hồ sơ công ty</a></p>
                    <!-- <p>văn hóa doanh nghiệp</p> -->
                    <p><a href="/love">Tâm huyết với công ích</a></p>
                    <p><a href="/law">Trợ giúp pháp lý</a></p>
                    <p><a href="/adv">Tuyển dụng nội bộ</a></p>
                    <p><a href="/company">Liên hệ với chúng tôi</a></p>
                </div>
            </div>

            <div class="footer_ri">
                <div class="footer_ri_ti">Luôn kết nối</div>
                <div class="footer_ri_in">
                    <input type="text">
                    <div class="btn">Gửi email</div>
                </div>

                <div class="footer_ri_p">
                    <p>Thành phố Hồ Chí Minh 207 Cây Bàng, Tân</p>
                    <p>Kiên, Bình Chánh, Thành phố Hồ Chí Minh, </p>
                    <p>Việt Nam</p>
                </div>
            </div>

        </div>

        <div v-else>
            <div class="small-footer">
                <img class="footer_le_logo" src="@/assets/footer/batlogo.png" alt="">
                <div class="footer_ce_ti">Liên kết nhanh</div>
                <div class="footer_ce_p">
                    <p><a href="/company">Hồ sơ công ty</a></p>
                    <!-- <p>văn hóa doanh nghiệp</p> -->
                    <p><a href="/love">Tâm huyết với công ích</a></p>
                    <p><a href="/law">Trợ giúp pháp lý</a></p>
                    <p><a href="/adv">Tuyển dụng nội bộ</a></p>
                    <p><a href="/company">Liên hệ với chúng tôi</a></p>
                    <!-- Hồ sơ công ty
                    văn hóa doanh nghiệp       
                    Tâm huyết với công ích      
                    Trợ giúp pháp lý       
                    Tuyển dụng nội bộ      
                    Liên hệ với chúng tôi  -->
                </div>
                <div class="footer_ce_ti">Luôn kết nối</div>
                <div class="footer_ri_in">
                    <input type="text">
                    <div class="btn">Gửi email</div>
                </div>

                <div class="footer_ri_p">
                    <p>Thành phố Hồ Chí Minh 207 Cây Bàng, Tân</p>
                    <p>Kiên, Bình Chánh, Thành phố Hồ Chí Minh, </p>
                    <p>Việt Nam</p>
                </div>
                <div class="footer_le_app">
                    <a href="https://www.linkedin.com/" target="_blank"><img src="../assets/footer/I.png"></a>
                    <a href="https://x.com/i/flow/login" target="_blank"><img src="../assets/footer/T.png"></a>
                    <a href="https://www.facebook.com/" target="_blank"><img src="../assets/footer/F.png"></a>
                    <a href="https://www.tiktok.com/en/" target="_blank"><img src="../assets/footer/D.png"></a>
                    <a href="https://www.youtube.com/" target="_blank"><img src="../assets/footer/Y.png"></a>
                    <a href="https://www.instagram.com/" target="_blank"><img src="../assets/footer/IN.png"></a>
                </div>
            </div>
        </div>
    <div style="width: 100%; height: 20px;"></div>

    </footer>
</template>

<script setup>
// import { ref } from 'vue';
// const language = ref('en');
import { ref,onMounted,onUnmounted} from 'vue';
const isSidebarVisible = ref(true)
onMounted(()=>{
    checkSidebarVisibility();
    window.addEventListener('resize', checkSidebarVisibility);
})
onUnmounted(()=>{
    window.removeEventListener('resize', checkSidebarVisibility);
})
const checkSidebarVisibility = () => {
    isSidebarVisible.value = window.innerWidth > 700;
}
</script>


<style lang="less" scoped>
.footer {
    color: #000;
    background: #eee;

    // height: 309px;
    .pc {
        box-sizing: border-box;
        padding: 30px 0 100px;
        display: flex;
        justify-content: center;
    }
    .small-footer{
        padding-top:20px;
        padding-left:60px;
        .footer_le_logo{
            width: 124px;
            height: 63px;
            cursor: pointer;
        }
        .footer_ce_ti{
            color: #161616;
            font-weight: 600;
            margin-top:14px;
            margin-bottom:14px;
        }
        .footer_ce_p{
            font-weight: 400;
            color: #000;
            line-height: 22px;
            font-size: 12px;
        }
        .footer_ri_ti{
            color: #161616;
            font-weight: 600;
        }
        .footer_ri_in{
            width: 223px;
            height: 32px;
            background: #fff;
            position: relative;
            margin: 17px 0 42px;
            input{
                width: 100%;
                height: 100%;
                border: none;
                outline: none;
                padding: 0 75px 0 10px;
            }
            .btn{
                top: 5px;
                right: 3px;
                position: absolute;
                width: 70px;
                height: 22px;
                background: #00A0E9;
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                cursor: pointer;
            }
        }
        .footer_ri_p{
            font-weight: 400;
            font-size: 12px;
            color: #000;
            line-height: 20px;
        }
        .footer_le_app{
            margin-top: 13px;
            display: flex;
            img{
                width: 17px;
                height: 17px;
                cursor: pointer;
                margin-right: 14px;
            }
        }
    }
    .footer_le {
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        .footer_le_logo {
            width: 124px;
            height: 63px;
            cursor: pointer;
        }

        .footer_le_app {
            margin-top: 83px;
            display: flex;

            img {
                width: 17px;
                height: 17px;
                cursor: pointer;
                margin-right: 14px;
            }
        }
    }

    .footer_ce {
        margin: 0 120px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        .footer_ce_ti {
            color: #161616;
            font-weight: 600;
        }

        .footer_ce_p {
            font-weight: 400;
            color: #000;
            line-height: 22px;
            font-size: 12px;
        }
    }

    .footer_ri {
        .footer_ri_ti {
            color: #161616;
            font-weight: 600;
        }

        .footer_ri_in {
            width: 223px;
            height: 32px;
            background: #fff;
            position: relative;
            margin: 17px 0 42px;

            input {
                width: 100%;
                height: 100%;
                border: none;
                outline: none;
                padding: 0 75px 0 10px;
            }

            .btn {
                top: 5px;
                right: 3px;
                position: absolute;
                width: 70px;
                height: 22px;
                background: #00A0E9;
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                cursor: pointer;
            }
        }

        .footer_ri_p {
            font-weight: 400;
            font-size: 12px;
            color: #000;
            line-height: 20px;
        }
    }
}
</style>