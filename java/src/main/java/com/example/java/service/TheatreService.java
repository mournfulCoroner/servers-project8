package com.example.java.service;

import com.example.java.modules.Theatre;
import com.example.java.repository.TheatreRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@RequiredArgsConstructor
public class TheatreService {
    private final TheatreRepository theatreRepository;

    public List<Theatre> selectAll() {
        return theatreRepository.selectAll();
    }

    public boolean insert(Theatre theatre) {
        return theatreRepository.insert(theatre);
    }

    public boolean update(Theatre theatre) {
        return theatreRepository.update(theatre);
    }

    public boolean delete(Integer id) {
        return theatreRepository.delete(id);
    }
}
