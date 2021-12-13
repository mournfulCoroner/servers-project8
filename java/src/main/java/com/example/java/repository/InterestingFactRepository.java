package com.example.java.repository;

import com.example.java.modules.InterestingFact;
import lombok.RequiredArgsConstructor;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
@RequiredArgsConstructor
public class InterestingFactRepository {
    private final JdbcTemplate jdbcTemplate;

    public List<InterestingFact> selectAll() {
        String SQL = "SELECT * FROM interesting_facts";
        return jdbcTemplate.query(SQL, new BeanPropertyRowMapper<>(InterestingFact.class));
    }

    public boolean insert(InterestingFact interestingFact) {
        String SQL = "INSERT INTO interesting_facts (title, text, url_video) VALUES (?, ?, ?)";
        return jdbcTemplate.update(
                SQL,
                interestingFact.getTitle(),
                interestingFact.getText(),
                interestingFact.getUrlVideo()
        ) > 0;
    }

    public boolean update(InterestingFact interestingFact) {
        String SQL = "UPDATE interesting_facts SET title=?, text=?, url_video=? WHERE ID=?";
        return jdbcTemplate.update(
                SQL,
                interestingFact.getTitle(),
                interestingFact.getText(),
                interestingFact.getUrlVideo()
        ) > 0;
    }

    public boolean delete(Integer id) {
        String SQL = "DELETE FROM `interesting_facts` WHERE `ID`=?";
        return jdbcTemplate.update(SQL, id) > 0;
    }
}
