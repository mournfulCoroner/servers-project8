package com.example.java.controller;

import com.example.java.service.InterestingFactService;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;

@Controller
@RequestMapping("/interesting-facts")
@RequiredArgsConstructor
public class InterestingFactController {
    private final InterestingFactService interestingFactService;

    @GetMapping
    public String index(Model model) {
        model.addAttribute("interestingFacts", interestingFactService.selectAll());

        return "interestingFact";
    }

}
