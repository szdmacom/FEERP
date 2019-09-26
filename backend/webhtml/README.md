打包流程记录

第一步：根目录屏 /vue.config.js 找到以下代码 屏蔽 
    // proxy: {
    //   // change xxx-api/login => mock/login
    //   // detail: https://cli.vuejs.org/config/#devserver-proxy
    //   [process.env.VUE_APP_BASE_API]: {
    //     // target: `http://127.0.0.1:${port}/mock`,
    //     target: `http://feerp.loc`,
    //     changeOrigin: true,
    //     pathRewrite: {
    //       ['^' + process.env.VUE_APP_BASE_API]: ''
    //     }
    //   }
    // },
    // after: require('./mock/mock-server.js')
    
    
第二步：/src/main.js 屏蔽以下代码 
    import { mockXHR } from '../mock'
    if (process.env.NODE_ENV === 'production') {
      mockXHR()
    }
 第一步和第二步为屏蔽mock数据
 
第三步：publicPath: './', // 相对路径 ./ 绝对路径 / 

第四步：/.env.production 设置 VUE_APP_BASE_API = '/' 这个为接口访问地址路径


第五步： build文件放置位置配置 /vue.config.js  outputDir: '../../htdocs/admin', // 配置生成到项目的生产目录中去，在生产环境也可以灵活配置

第六步：cd backend\webhtml 执行 yarn run build:prod  

