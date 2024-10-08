import axios from 'axios';
const API_URL = 'https://api.ttvnvn.com/api/';

//获取招聘列表
export async function fetchAdvLists(cid, page_no, page_size, keyword) {
  const response = await axios.get(API_URL+'index/jobs', {
    params: {cid, page_no, page_size, keyword}
  });
  return response.data;
}
//获取常量文章详情
export async function fetchConfigArticlesInfo(key) {
  const response = await axios.get(API_URL+'article/configInfo', {
    params: {key}
  });
  return response.data;
}
//获取文章详情
export async function fetchArticlesInfo(id) {
    const response = await axios.get(API_URL+'article/detail', {
      params: {id}
    });
    return response.data;
}
//获取文章列表（cid:文章分类）
export async function fetchArticles(cid, page_no, page_size, keyword) {
  const response = await axios.get(API_URL+'article/lists', {
    params: {cid, page_no, page_size, keyword}
  });
  return response.data;
}
//获取轮播图
export async function fetchBanner(type) {
    const response = await axios.get(API_URL+'index/banner', {
      params:{type}
    });
    return response.data;
}