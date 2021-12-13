package com.example.java.controller;

import com.example.java.modules.InterestingFact;
import com.example.java.service.InterestingFactService;
import lombok.RequiredArgsConstructor;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

@RestController
@RequestMapping("/api/interesting-facts")
@RequiredArgsConstructor
public class InterestingFactRestController {
    private final InterestingFactService interestingFactService;

    @GetMapping
    public List<InterestingFact> get() {
        return interestingFactService.selectAll();
    }

    @PostMapping
    public Boolean post(@RequestBody InterestingFact interestingFact) {
        return interestingFactService.insert(interestingFact);
    }

    @PutMapping
    public Boolean put(@RequestBody InterestingFact interestingFact) {
        return interestingFactService.update(interestingFact);
    }

    @DeleteMapping("/{id}")
    public Boolean delete(@PathVariable Integer id) {
        return interestingFactService.delete(id);
    }
}
