package com.example.java.controller;

import com.example.java.dto.UploadPdfDTO;
import com.example.java.modules.InterestingFact;
import com.example.java.modules.User;
import com.example.java.modules.UserInfo;
import com.example.java.service.FileService;
import com.example.java.service.InterestingFactService;
import com.example.java.service.UserService;
import com.example.java.utils.LanguageType;
import com.example.java.utils.ThemeType;
import com.example.java.utils.language.LanguageHelper;
import com.example.java.utils.session.SessionAttribute;
import com.example.java.utils.session.SessionHelper;
import lombok.RequiredArgsConstructor;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.multipart.MultipartFile;

import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

@Controller
@RequestMapping(value = "/admin")
@RequiredArgsConstructor
public class AdminController {
    private final FileService fileService;
    private final LanguageHelper languageHelper;
    private final UserService userService;
    private final InterestingFactService interestingFactService;

    @Value("${graphic.access.key}")
    private String graphicAccessKey;

    @GetMapping
    public String index(HttpSession session, Model model) {
        SessionHelper sessionHelper = new SessionHelper(session);

        LanguageType language = (LanguageType) sessionHelper.getAttribute(SessionAttribute.LANGUAGE);
        ThemeType theme = (ThemeType) sessionHelper.getAttribute(SessionAttribute.THEME);
        String name = (String) sessionHelper.getAttribute(SessionAttribute.NAME);

        model.addAttribute("userInfo", new UserInfo());

        model.addAttribute("sessionLanguage", language);
        model.addAttribute("nickname", name);
        model.addAttribute("sessionTheme", theme);

        model.addAttribute("files", fileService.getFilesInfo());
        model.addAttribute("dictionary", languageHelper.getDictionary(language));

        model.addAttribute("users", userService.selectAll());
        model.addAttribute("interestingFacts", interestingFactService.selectAll());

        return "admin";
    }

    @GetMapping("/graphics")
    public String graphics(HttpServletResponse response) {
        Cookie cookie = new Cookie("graphic_access_key", graphicAccessKey); // ключ для графиков
        cookie.setSecure(true);
        cookie.setHttpOnly(true);

        response.addCookie(cookie);

        return "graphics";
    }

    @PostMapping("/setting")
    public String setUserInfo(@ModelAttribute UserInfo userInfo, HttpSession session) {
        SessionHelper sessionHelper = new SessionHelper(session);

        sessionHelper.setAttribute(SessionAttribute.LANGUAGE, userInfo.getLanguage());
        sessionHelper.setAttribute(SessionAttribute.NAME, userInfo.getName());
        sessionHelper.setAttribute(SessionAttribute.THEME, userInfo.getTheme());

        return "redirect:/admin";
    }

    @PostMapping("/pdf")
    public String uploadPdf(@ModelAttribute UploadPdfDTO uploadPdfDTO) {
        MultipartFile userFile = uploadPdfDTO.getUserfile();

        if (userFile.getContentType().equals("application/pdf")) {
            fileService.saveFile(userFile);
        }

        return "redirect:/admin";
    }

    @PostMapping("/users")
    public String insertUser(@ModelAttribute User user) {
        userService.insert(user);

        return "redirect:/admin";
    }

    @DeleteMapping("/users/{id}")
    public String deleteUser(@PathVariable Integer id) {
        userService.delete(id);

        return "redirect:/admin";
    }

    @PostMapping("/interesting_fact")
    public String insertInterestingFact(@ModelAttribute InterestingFact interestingFact) {
        interestingFactService.insert(interestingFact);

        return "redirect:/admin";
    }

    @DeleteMapping("/interesting_fact/{id}")
    public String deleteInterestingFact(@PathVariable Integer id) {
        interestingFactService.delete(id);

        return "redirect:/admin";
    }
}
