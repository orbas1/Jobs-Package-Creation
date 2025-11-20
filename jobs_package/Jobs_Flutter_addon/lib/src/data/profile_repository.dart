import '../api/api_client.dart';
import '../models/models.dart';

class ProfileRepository {
  const ProfileRepository(this._apiClient);

  final JobsApiClient _apiClient;

  Future<Company> fetchCompany(int id) async {
    final payload = await _apiClient.getJson('/api/companies/$id');
    return Company.fromJson(payload['data'] as Map<String, dynamic>);
  }

  Future<CandidateProfile> fetchCandidate(int id) async {
    final payload = await _apiClient.getJson('/api/candidates/$id');
    return CandidateProfile.fromJson(payload['data'] as Map<String, dynamic>);
  }

  Future<CvDocument> saveCv({required int candidateId, required CvDocument cv}) async {
    final payload = await _apiClient.putJson(
      '/api/candidates/$candidateId/cv',
      body: cv.toJson(),
    );
    return CvDocument.fromJson(payload['data'] as Map<String, dynamic>);
  }

  Future<CoverLetter> saveCoverLetter({
    required int candidateId,
    required CoverLetter coverLetter,
  }) async {
    final payload = await _apiClient.putJson(
      '/api/candidates/$candidateId/cover-letter',
      body: coverLetter.toJson(),
    );
    return CoverLetter.fromJson(payload['data'] as Map<String, dynamic>);
  }
}
