package com.example.java.controller;

import com.example.java.service.TheatreService;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;

@Controller
@RequestMapping("/theatres")
@RequiredArgsConstructor
public class TheatreController {
    private final TheatreService theatreService;

    @GetMapping
    public String index(Model model) {
        model.addAttribute("theatres", theatreService.selectAll());

        return "theatre";
    }

}
