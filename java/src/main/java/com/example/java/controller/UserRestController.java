package com.example.java.controller;

import com.example.java.modules.InterestingFact;
import com.example.java.modules.User;
import com.example.java.service.UserService;
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
@RequestMapping("/api/users")
@RequiredArgsConstructor
public class UserRestController {
    private final UserService userService;

    @GetMapping
    public List<User> get() {
        return userService.selectAll();
    }

    @PostMapping
    public Boolean post(@RequestBody User user) {
        return userService.insert(user);
    }

    @PutMapping
    public Boolean put(@RequestBody User user) {
        return userService.update(user);
    }

    @DeleteMapping("/{id}")
    public Boolean delete(@PathVariable Integer id) {
        return userService.delete(id);
    }
}
