package com.example.java.service;

import com.example.java.modules.User;
import com.example.java.repository.UserRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@RequiredArgsConstructor
public class UserService {
    private final UserRepository userRepository;

    public List<User> selectAll() {
        return userRepository.selectAll();
    }

    public boolean insert(User user) {
        return userRepository.insert(user);
    }

    public boolean update(User user) {
        return userRepository.update(user);
    }

    public boolean delete(Integer id) {
        return userRepository.delete(id);
    }
}
