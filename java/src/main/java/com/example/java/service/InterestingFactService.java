package com.example.java.service;

import com.example.java.modules.InterestingFact;
import com.example.java.repository.InterestingFactRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@RequiredArgsConstructor
public class InterestingFactService {
    private final InterestingFactRepository interestingFactRepository;

    public List<InterestingFact> selectAll() {
        return interestingFactRepository.selectAll();
    }

    public boolean insert(InterestingFact interestingFact) {
        return interestingFactRepository.insert(interestingFact);
    }

    public boolean update(InterestingFact interestingFact) {
        return interestingFactRepository.update(interestingFact);
    }

    public boolean delete(Integer id) {
        return interestingFactRepository.delete(id);
    }
}
