$(function () {
  //ハンバーガーメニュー
  $('#js-hamburger-menu, .navigation__link').on('click', function () {
    $('.navigation').slideToggle(500)
    $('.hamburger-menu').toggleClass('hamburger-menu--open')
  });
  //文字のスライド表示
  $(window).scroll(function(){
    $('.js-trigger').each(function(){
      var scroll = $(window).scrollTop();
      var pos = $(this).offset().top;
      var delay = 400;
      if (scroll > pos - delay){
        $(this).addClass('is-active');
      }
    });
  });
  //アコーディオン機能
  $(".accordion-title").on("click", function(){
    $(this).next().slideToggle(200);
    $(this).toggleClass("open", 200);
  });
  //スライドショー機能
  $('.slider').slick({
      autoplay:true,
      autoplaySpeed: 1800,
      fade:true,
      arrows:true,
  });

});





/* オープンアニアニメーション */

const fv = document.querySelector(".fv"); //.fvの取得
const bgLeft = document.querySelector(".bg--left"); //.bgの取得
const bgRight = document.querySelector(".bg--right"); //.bgの取得
const logo = document.querySelector("#logo"); //#logoの取得
const menu = document.querySelector(".menu"); //.menuの取得
const title = document.querySelector(".title"); //.titleの取得
const tl = gsap.timeline();
// tl.To(".loader", {
//    y: "-100%",
//    duration: 5,
// });

//ここからtimelineの記述

//ローディングアニメーション
tl.fromTo(
  ".loader",
  {
    y: "0%",
    duration: 5,
  },
  {
    y: "-100%",
    duration: 4,
    ease: "power3.inOut",
  },
)

//オープンアニメーション

tl.fromTo(


  //画像の高さ0%から80%に変える
    fv, //変数fvに対して
    {
      height: "0%",
    },
    {
      height: "80%",
      duration: 1, //アニメーション時間
      ease: "power3.inOut", //イージングの指定
    }
  )
    .fromTo(
    //画像の横幅を100%から80%に変える
      fv,
      {
        width: "100%",
      },
      {
        width: "80%",
        duration: 1, //アニメーション時間
        ease: "power3.in", //イージングの指定
      }
    )
    .fromTo(
    //左半分の背景を上から下へスライド
      bgLeft,
      {
        y: "-100%",
      },
      {
        y: "0%",
        duration: 1.5, //アニメーション時間
        ease: "power2.inOut", //イージングの指定
      },
      "-=1" //前のアニメーションが終わる時に対して1s早く始める
    )
    .fromTo(
    //右半分の背景を下から上へスライド
      bgRight,
      {
        y: "100%",
      },
      {
        y: "0%",
        duration: 1.5, //アニメーション時間
        ease: "power2.inOut", //イージングの指定
      },
      "-=1.5" //前のアニメーションが終わる時に対して1.5s早く始める
    )
    .fromTo(
    //ロゴを右から左へ出現
      logo,
      {
        opacity: 0,
        x: 30,
      },
      {
        opacity: 1,
        x: 0,
        duration: 0.5, //アニメーション時間
      },
      "-=0.5" //前のアニメーションが終わる時に対して0.5s早く始める
    )
    .fromTo(
    //テクストを左から右へ出現
      title,
      {
        opacity: 0,
        x: -30,
      },
      {
        opacity: 1,
        x: 0,
        duration: 0.5, //アニメーション時間
      },
      "-=0.5" //前のアニメーションが終わる時に対して0.5s早く始める
    );





