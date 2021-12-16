package com.example.java.controller;

import com.example.java.modules.Theatre;
import com.example.java.service.TheatreService;
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
@RequestMapping("/api/theatres")
@RequiredArgsConstructor
public class TheatreRestController {
    private final TheatreService theatreService;

    @GetMapping
    public List<Theatre> get() {
        return theatreService.selectAll();
    }

    @PostMapping
    public Boolean post(@RequestBody Theatre theatre) {
        return theatreService.insert(theatre);
    }

    @PutMapping
    public Boolean put(@RequestBody Theatre theatre) {
        return theatreService.update(theatre);
    }

    @DeleteMapping("/{id}")
    public Boolean delete(@PathVariable Integer id) {
        return theatreService.delete(id);
    }
}
