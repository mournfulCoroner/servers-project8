//package com.example.java.service;
//
//import com.example.java.modules.User;
//import com.example.java.modules.UserInfo;
//import com.example.java.repository.UserInfoRepository;
//import lombok.RequiredArgsConstructor;
//import org.springframework.stereotype.Service;
//
//@Service
//@RequiredArgsConstructor
//public class UserInfoService {
//    private final UserInfoRepository userInfoRepository;
//
//    public final UserInfo findById(Integer id) {
//        UserInfo userInfo = userInfoRepository.findById(id).orElse(null);
//
//        if (userInfo == null) {
//            UserInfo defaultUserInfo = new UserInfo();
//
//            defaultUserInfo.setId(id);
//            defaultUserInfo.setLanguage("ru");
//            defaultUserInfo.setTheme("light");
//            defaultUserInfo.setName("Безымяный");
//
//            userInfoRepository.save(defaultUserInfo);
//        }
//
//        return userInfo;
//    }
//
//    public final void change(UserInfo userInfo) {
//        userInfoRepository.save(userInfo);
//    }
//}
